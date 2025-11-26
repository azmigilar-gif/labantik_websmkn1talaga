<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_ExpertiseConcentration;
use App\Models\CoreExpertiseConcentration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExpertiseController extends Controller
{
    /**
     * Handle image upload from CKEditor/Quill
     */
    public function uploadImage(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            Log::warning('expertise.uploadImage unauthenticated attempt', ['ip' => $request->ip()]);
            return response()->json(['error' => ['message' => 'Unauthenticated']], 401);
        }

        // Accept several field names for file upload
        $candidateFields = ['upload', 'image', 'file', 'files', 'files[]'];
        $fileField = null;
        foreach ($candidateFields as $f) {
            if ($request->hasFile($f)) {
                $fileField = $f;
                break;
            }
        }
        if (!$fileField) {
            Log::warning('expertise.uploadImage no file field present', ['input' => array_keys($request->all())]);
            return response()->json(['error' => ['message' => 'No image uploaded']], 400);
        }

        $image = $request->file($fileField);
        if (!$image->isValid()) {
            Log::error('expertise.uploadImage invalid upload', ['error' => $image->getErrorMessage()]);
            return response()->json(['error' => ['message' => 'Uploaded file is not valid']], 400);
        }

        try {
            // Generate safe unique filename
            $safeName = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '_' . $safeName . '.' . $extension;

            // Store uploads in public/assets
            $dirPath = 'assets/images/expertise/' . date('Y') . '/' . date('m') . '/' . date('d');
            $publicDir = public_path($dirPath);
            if (!file_exists($publicDir)) {
                mkdir($publicDir, 0755, true);
            }
            $image->move($publicDir, $filename);
            $path = $dirPath . '/' . $filename;

            // Build URL
            $url = asset($path);
            Log::info('expertise.uploadImage stored', ['path' => $path, 'url' => $url, 'user' => Auth::id()]);

            // Return JSON response for editor
            return response()->json(['url' => $url, 'default' => $url]);
        } catch (\Exception $e) {
            Log::error('expertise.uploadImage exception', ['message' => $e->getMessage()]);
            return response()->json(['error' => ['message' => 'Failed to store uploaded image']], 500);
        }
    }

    /**
     * Display a listing of expertise concentrations
     */
    public function index()
    {
        $expertises = S_ExpertiseConcentration::with('core')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(15);

        // Get core expertise concentrations for dropdown/reference
        $cores = CoreExpertiseConcentration::orderBy('name')->get();

        return view('admin.expertise.index', compact('expertises', 'cores'));
    }

    /**
     * Show the form for creating a new expertise concentration
     */
    public function create()
    {
        $cores = CoreExpertiseConcentration::orderBy('name')->get();
        return view('admin.expertise.create', compact('cores'));
    }

    /**
     * Store a newly created expertise concentration
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_concentrations' => 'required|exists:core_expertise_concentrations,id',
            'description' => 'required|string',
        ]);

        Log::debug('expertise.store input', $request->all());

        // Ensure description is a string
        $description = trim($data['description'] ?? '');

        $expertise = new S_ExpertiseConcentration();
        $expertise->id = (string) Str::uuid();
        $expertise->id_concentrations = $data['id_concentrations'];
        $expertise->description = $description;
        $expertise->save();

        return redirect()->route('admin.expertise.index')->with('success', 'Konsentrasi Keahlian berhasil dibuat.');
    }

    /**
     * Display the specified expertise concentration
     */
    public function show($id)
    {
        $expertise = S_ExpertiseConcentration::with('core')->findOrFail($id);
        return view('admin.expertise.show', compact('expertise'));
    }

    /**
     * Show the form for editing the specified expertise concentration
     */
    public function edit($id)
    {
        $expertise = S_ExpertiseConcentration::findOrFail($id);
        $cores = CoreExpertiseConcentration::orderBy('name')->get();
        return view('admin.expertise.edit', compact('expertise', 'cores'));
    }

    /**
     * Update the specified expertise concentration
     */
    public function update(Request $request, $id)
    {
        $expertise = S_ExpertiseConcentration::findOrFail($id);

        $data = $request->validate([
            'id_concentrations' => 'required|exists:core_expertise_concentrations,id',
            'description' => 'required|string',
        ]);

        $expertise->id_concentrations = $data['id_concentrations'];
        $expertise->description = trim($data['description'] ?? '');
        $expertise->save();

        return redirect()->route('admin.expertise.index')->with('success', 'Konsentrasi Keahlian berhasil diperbarui.');
    }

    /**
     * Remove the specified expertise concentration
     */
    public function destroy($id)
    {
        $expertise = S_ExpertiseConcentration::findOrFail($id);

        try {
            $expertise->delete();
            return redirect()->route('admin.expertise.index')->with('success', 'Konsentrasi Keahlian berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('expertise.destroy failed', ['id' => $id, 'message' => $e->getMessage()]);
            return redirect()->route('admin.expertise.index')->with('error', 'Gagal menghapus Konsentrasi Keahlian.');
        }
    }
}

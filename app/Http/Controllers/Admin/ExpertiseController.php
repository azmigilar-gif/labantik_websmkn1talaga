<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreExpertiseConcentration;
use App\Models\S_ExpertiseConcentration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ExpertiseController extends Controller
{
    public function index()
    {
        $cores = CoreExpertiseConcentration::with('sDescription')->orderBy('name')->get();
        return view('admin.expertise.index', compact('cores'));
    }

    public function create(Request $request)
    {
        // get core items that do not yet have an s_expertise_concentration
        $existing = S_ExpertiseConcentration::pluck('id_concentrations')->all();
        $cores = CoreExpertiseConcentration::whereNotIn('id', $existing)->orderBy('name')->get();
        $selected = $request->query('id');

        return view('admin.expertise.create', compact('cores', 'selected'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_concentrations' => 'required|uuid',
            'description' => 'required|string',
        ]);

        // prevent duplicate
        if (S_ExpertiseConcentration::where('id_concentrations', $data['id_concentrations'])->exists()) {
            return redirect()->back()->withErrors(['id_concentrations' => 'Deskripsi untuk jurusan ini sudah ada.']);
        }

        try {
            $s = new S_ExpertiseConcentration();
            $s->id = (string) Str::uuid();
            $s->id_concentrations = $data['id_concentrations'];
            $s->description = $data['description'];
            $s->save();

            return redirect()->route('admin.expertise.index')->with('success', 'Deskripsi jurusan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('expertise.store failed', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan deskripsi.']);
        }
    }

    public function show($id)
    {
        $core = CoreExpertiseConcentration::with('sDescription')->findOrFail($id);
        return view('admin.expertise.show', compact('core'));
    }

    public function edit($id)
    {
        $core = CoreExpertiseConcentration::with('sDescription')->findOrFail($id);
        if (!$core->sDescription) {
            return redirect()->route('admin.expertise.create', ['id' => $core->id])->with('info', 'Belum ada deskripsi, silakan tambah.');
        }
        return view('admin.expertise.edit', compact('core'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $record = S_ExpertiseConcentration::where('id_concentrations', $id)->firstOrFail();
        $record->description = $request->description;
        $record->save();

        return redirect()->route('admin.expertise.index')->with('success', 'Deskripsi berhasil diperbarui.');
    }
}

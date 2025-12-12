<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_Categories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cat = new S_Categories();
        $cat->id = (string) Str::uuid();
        $cat->name = $data['name'];
        // set the creating user if available
        $cat->user_id = Auth::id() ?? null;
        $cat->save();

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Update the specified category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cat = S_Categories::findOrFail($id);
        $cat->name = $data['name'];
        // record the user who updated (keep existing if not available)
        $cat->user_id = Auth::id() ?? $cat->user_id;
        $cat->save();

        return redirect()->back()->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        try {
            $cat = S_Categories::findOrFail($id);

            // Cek apakah kategori sedang digunakan oleh berita
            $newsCount = DB::table('s_news')
                ->where('s_category_id', $id)
                ->count();

            if ($newsCount > 0) {
                return redirect()->back()->with(
                    'error',
                    "Kategori tidak dapat dihapus karena masih digunakan oleh {$newsCount} berita. Silakan hapus atau pindahkan berita tersebut terlebih dahulu."
                );
            }

            $cat->delete();

            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }
}

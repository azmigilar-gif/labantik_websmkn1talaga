<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\S_Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = new S_Tags();
        $tag->id = (string) Str::uuid();
        $tag->name = $data['name'];
        $tag->save();

        return redirect()->back()->with('success', 'Tag berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = S_Tags::findOrFail($id);
        $tag->name = $data['name'];
        $tag->save();

        return redirect()->back()->with('success', 'Tag berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tag = S_Tags::findOrFail($id);
        $tag->delete();

        return redirect()->back()->with('success', 'Tag berhasil dihapus.');
    }
}

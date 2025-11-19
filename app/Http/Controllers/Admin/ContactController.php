<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\S_Contact;
use App\Models\S_Menu as Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = S_Contact::with('menu')->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        $menus = Menu::orderBy('name')->get();
        return view('admin.contacts.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:50',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        $contact = new S_Contact();
        $contact->id = (string) Str::uuid();
        $contact->address_1 = $data['address_1'];
        $contact->address_2 = $data['address_2'] ?? null;
        $contact->email = $data['email'] ?? null;
        $contact->no_telp = $data['no_telp'] ?? null;
        $contact->created_by = Auth::id();
        $contact->updated_by = Auth::id();
        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $contact->s_menu_id = $data['s_menu_id'];
        }
        $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact berhasil dibuat.');
    }

    public function show($id)
    {
        $contact = S_Contact::with('menu')->findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = S_Contact::findOrFail($id);
        $menus = Menu::orderBy('name')->get();
        return view('admin.contacts.edit', compact('contact', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $contact = S_Contact::findOrFail($id);
        $data = $request->validate([
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_telp' => 'nullable|string|max:50',
            's_menu_id' => 'nullable|string|max:255',
        ]);

        $contact->address_1 = $data['address_1'];
        $contact->address_2 = $data['address_2'] ?? null;
        $contact->email = $data['email'] ?? null;
        $contact->no_telp = $data['no_telp'] ?? null;
        if (!empty($data['s_menu_id']) && preg_match('/^[0-9a-fA-F\-]{36}$/', $data['s_menu_id']) && Menu::where('id', $data['s_menu_id'])->exists()) {
            $contact->s_menu_id = $data['s_menu_id'];
        }
        $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $contact = S_Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact berhasil dihapus.');
    }
}

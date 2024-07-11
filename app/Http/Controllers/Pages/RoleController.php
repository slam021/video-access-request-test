<?php

namespace App\Http\Controllers\Pages;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('pages.roles.create');
    }

    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required',
        ]);

        $create_role = Role::create($validation);

        return redirect()->route('role.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('pages.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $validation['name'],
        ]);
        return redirect()->route('role.index')->with('success', 'Data berhasil Diupdate!');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        //redirect to index
        return redirect()->route('role.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

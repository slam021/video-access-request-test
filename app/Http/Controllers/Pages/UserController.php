<?php

namespace App\Http\Controllers\Pages;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|',
            'password' => 'required',
        ]);


        $validation['password'] = Hash::make($request->password);
        // dd($validation);

        $create_user = User::create($validation);

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id)
    {
        $roles = Role::all();

        $user = User::findOrFail($id);

        return view('pages.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|',
            'password' => 'required',
        ]);


        $validation['password'] = Hash::make($request->password);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validation['name'],
            'user_name' => $validation['user_name'],
            'role_id' => $validation['role_id'],
            'email' => $validation['email'],
            'password' => $validation['email'],
        ]);
        return redirect()->route('user.index')->with('success', 'Data berhasil Diupdate!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

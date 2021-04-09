<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users/users');
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users/users-create')->with(compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        User::create([
            'lastName' => strtoupper($request->input('lastName')),
            'firstName' => ucfirst($request->input('firstName')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telephoneNumber' => $request->input('telephoneNumber'),
            'role_id' => $request->input('role'),
        ]);
        return redirect('users');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users/users-update')->with(compact('user', 'roles'));
    }

    public function editPassword($id)
    {
        $user = User::find($id);
        return view('users/users-password-update')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->lastName = strtoupper($request->input('lastName'));
        $user->firstName = ucfirst($request->input('firstName'));
        $user->email = $request->input('email');
        $user->telephoneNumber = $request->input('telephoneNumber');
        $user->role_id = $request->input('role');
        $user->save();

        return redirect('users');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('users');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('users');
    }

}

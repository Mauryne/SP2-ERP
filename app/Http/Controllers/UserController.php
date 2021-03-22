<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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
            'lastName' => $request->input('lastName'),
            'firstName' => $request->input('firstName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telephoneNumber' => $request->input('telephoneNumber'),
            'role_id' => $request->input('role'),
        ]);
        return redirect('users');
    }
}

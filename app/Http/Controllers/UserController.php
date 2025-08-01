<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Returns the Blade view for user details
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function create()
    {
        // Check permissions: only admin and coordinator can create users
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'coordinator'])) {
            abort(403, 'No tienes permisos para crear usuarios.');
        }
        // available roles for user creation
        return view('users.create');
        // Check permissions again (maybe I should remove this)
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'coordinator'])) {
            abort(403, 'No tienes permisos para crear usuarios.');
        }
    }

    public function store(Request $request)
    {
        // Check permissions: only admin and coordinator can create users!
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'coordinator'])) {
            abort(403, 'No tienes permisos para crear usuarios.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,coordinator,professor',
            'password' => 'required|string|min:6',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
         // Check permissions again (maybe I also should remove this)
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'coordinator'])) {
            abort(403, 'No tienes permisos para crear usuarios.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')
            ->paginate(10);

        return Inertia::render('Admin/Users/Index', ['users' => $users]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created!');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        if ($user->events()->count() > 0) {
            return redirect()->back()->with('success', 'Cannot delete user with registrations.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted!');
    }
}

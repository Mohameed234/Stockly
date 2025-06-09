<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }
        return view('users.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'You do not have permission to create users.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'You do not have permission to edit users.');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'You do not have permission to update users.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'You do not have permission to delete users.');
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('users.index')->with('error', 'Cannot delete the last admin user.');
        }

        if ($user->id === auth()->id()) {
            auth()->logout();
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

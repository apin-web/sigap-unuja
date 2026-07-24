<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::latest()->get();
        return view('users.index', compact('data'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|unique:users,identifier',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,guard,admin',
            'department' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'identifier' => $request->identifier,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|unique:users,identifier,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:student,guard,admin',
            'department' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'identifier' => $request->identifier,
            'role' => $request->role,
            'department' => $request->department,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
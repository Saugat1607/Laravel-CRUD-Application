<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Admin dashboard - show all users
    public function index()
    {
        if (!session()->has('is_admin')) {
            abort(403, 'Unauthorized access.');
        }

        $users = User::with('products')->get();
        return view('admin.dashboard', compact('users'));
    }

    // Show products of a specific user
    public function userProducts($id)
    {
        if (!session()->has('is_admin')) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        $products = $user->products;

        return view('products.index', compact('user', 'products'));
    }

    // ✅ Show edit user form
    public function editUser($id)
    {
        if (!session()->has('is_admin')) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    // ✅ Handle user update
    public function updateUser(Request $request, $id)
    {
        if (!session()->has('is_admin')) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'User updated successfully');
    }
}

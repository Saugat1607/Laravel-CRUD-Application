<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // -------- SHOW SIGNUP --------
    public function showRegister()
    {
        return view('signup');
    }

    // -------- HANDLE SIGNUP --------
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Account created successfully!');
    }

    // -------- SHOW LOGIN --------
    public function showLogin()
    {
        return view('login');
    }

    // -------- HANDLE LOGIN --------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // -------- FIXED ADMIN LOGIN --------
        $adminEmail = 'admin@gmail.com';
        $adminPassword = 'admin123';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session()->put('is_admin', true);

            // Optional: assign a dummy user so Auth::user() works in views
            if (!Auth::check()) {
                $adminUser = User::first(); // any user
                Auth::login($adminUser);
            }

            return redirect()->route('admin.dashboard');
        }

        // -------- NORMAL USER LOGIN --------
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('products.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    // -------- ADMIN DASHBOARD --------
    public function adminDashboard()
    {
        if (!session()->has('is_admin')) {
            abort(403, 'Unauthorized access.');
        }

        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // -------- LOGOUT --------
    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard-admin');
            } elseif ($user->role === 'pemilik') {
                return redirect()->intended('/pemilik/dashboard-pemilik');
            } else {
                return redirect()->intended('/penyewa/dashboard-penyewa');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRoleSelection()
    {
        return view('auth.role-selection');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:penyewa,pemilik',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect($request->role === 'pemilik' ? '/pemilik/dashboard-pemilik' : '/penyewa/dashboard-penyewa');
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:penyewa,pemilik',
        ]);

        // Gunakan Query Builder sebagai alternatif
        $affected = User::where('id', Auth::id())
            ->update(['role' => $request->role]);

        return redirect($request->role === 'pemilik' ? '/pemilik/dashboard-pemilik' : '/penyewa/dashboard-penyewa')
            ->with('success', 'Role berhasil diubah');
    }

    public function becomeOwner(Request $request)
    {
        // Gunakan Query Builder sebagai alternatif
        $affected = User::where('id', Auth::id())
            ->update(['role' => 'pemilik']);

        return redirect('/pemilik/dashboard-pemilik')->with('success', 'Selamat! Anda sekarang juga sebagai pemilik motor');
    }
}

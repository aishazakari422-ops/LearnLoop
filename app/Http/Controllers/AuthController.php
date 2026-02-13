<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,lecturer', // Allow choosing role for demo purposes or stick to student? User wireframe showed "Register" generally. Let's allow student by default or select. Wireframe didn't specify role selection. I'll default to student but maybe allow lecturer via a hidden flag or just a select box if appropriate. Let's keep it simple: just register as Student by default, or provide a select.
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'student',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        } elseif ($user->role === 'lecturer') {
            return view('lecturer.dashboard');
        } else {
            // Fetch goals for student with progress
            $goals = \App\Models\LearningGoal::where('user_id', $user->id)->with('progress')->latest()->get();
            $recommendations = $user->recommendationsReceived()->with('lecturer')->latest()->take(3)->get();
            return view('student.dashboard', compact('goals', 'recommendations'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
<<<<<<< HEAD
    public function dashboard()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_courses' => \App\Models\Course::count(),
            'total_goals' => \App\Models\LearningGoal::count(),
            'total_topics' => \App\Models\ForumTopic::count(),
        ];

        $recent_users = \App\Models\User::latest()->take(5)->get();
        $recent_courses = \App\Models\Course::with('instructor')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_courses'));
    }

    public function users()
    {
        $users = \App\Models\User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function updateRole(\App\Models\User $user, Request $request)
    {
        $request->validate([
            'role' => 'required|in:student,lecturer,admin'
        ]);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "Role for {$user->name} updated to {$request->role}.");
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} has been deleted.");
    }

    public function courses()
    {
        $courses = \App\Models\Course::with('instructor')->withCount('students')->latest()->paginate(15);
        return view('admin.courses', compact('courses'));
    }
=======
    public function index()
    {
        $users = \App\Models\User::paginate(10);
        return view('admin.users', compact('users'));
    }
>>>>>>> origin/main
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Display a listing of recommendations for the current student.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'student') {
            $recommendations = $user->recommendationsReceived()->with('lecturer')->latest()->get();
        } else {
            $recommendations = $user->recommendationsSent()->with('student')->latest()->get();
        }
        
        return view('recommendations.index', compact('recommendations'));
    }

    /**
     * Store a newly created recommendation in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'lecturer') {
            return back()->with('error', 'Only lecturers can make recommendations.');
        }

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'material_title' => 'required|string|max:255',
            'material_link' => 'nullable|url',
            'note' => 'nullable|string',
        ]);

        Recommendation::create([
            'student_id' => $request->student_id,
            'lecturer_id' => Auth::id(),
            'material_title' => $request->material_title,
            'material_link' => $request->material_link,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Recommendation sent successfully!');
    }

    /**
     * Remove the specified recommendation from storage.
     */
    public function destroy(Recommendation $recommendation)
    {
        if (Auth::id() !== $recommendation->student_id && Auth::id() !== $recommendation->lecturer_id) {
            abort(403);
        }

        $recommendation->delete();

        return back()->with('success', 'Recommendation removed successfully!');
    }
=======
class RecommendationController extends Controller
{
    //
>>>>>>> origin/main
}

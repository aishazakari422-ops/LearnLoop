<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningGoalController extends Controller
{
    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'target_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Create
        \App\Models\LearningGoal::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'target_date' => $request->target_date,
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'Learning goal created successfully!');
    }

    public function show($id)
    {
        $goal = \App\Models\LearningGoal::with(['materials', 'progress'])->findOrFail($id);
        
        // Security check
        if ($goal->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        return view('goals.show', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = \App\Models\LearningGoal::findOrFail($id);
        
        if ($goal->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'target_date' => 'nullable|date',
        ]);

        $goal->update($request->only(['title', 'description', 'start_date', 'target_date']));

        return redirect()->route('goals.show', $goal->id)->with('success', 'Goal updated successfully!');
    }
}

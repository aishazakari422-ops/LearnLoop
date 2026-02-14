<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningMaterialController extends Controller
{
    public function index()
    {
        $materials = \App\Models\LearningMaterial::whereHas('learningGoal', function ($query) {
            $query->where('user_id', \Illuminate\Support\Facades\Auth::id());
        })->with('learningGoal')->latest()->paginate(12);

        return view('materials.index', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'learning_goal_id' => 'required|exists:learning_goals,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,pdf,link',
            'content_url' => 'nullable|required_if:type,link,video|url',
            'file' => 'nullable|required_if:type,pdf|file|mimes:pdf,doc,docx,txt,mp4,avi|max:1048576', // Max 1GB
        ]);

        // Security check: ensure the goal belongs to the user
        $goal = \App\Models\LearningGoal::findOrFail($request->learning_goal_id);
        if ($goal->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $contentUrl = $request->content_url;

        // Handle file upload
        if ($request->hasFile('file') && $request->type === 'pdf') {
            $path = $request->file('file')->store('materials', 'public');
            $contentUrl = Storage::url($path);
        }

<<<<<<< HEAD
        $material = \App\Models\LearningMaterial::create([
=======
        \App\Models\LearningMaterial::create([
>>>>>>> origin/main
            'learning_goal_id' => $request->learning_goal_id,
            'title' => $request->title,
            'type' => $request->type,
            'content_url' => $contentUrl,
        ]);

<<<<<<< HEAD
        $goal->refreshProgress();

        return back()->with('success', 'Material added successfully!');
    }

    public function toggleComplete(\App\Models\LearningMaterial $material)
    {
        if ($material->learningGoal->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $material->is_completed = !$material->is_completed;
        $material->save();

        $percentage = $material->learningGoal->refreshProgress();

        return response()->json([
            'success' => true,
            'is_completed' => $material->is_completed,
            'percentage' => $percentage
        ]);
    }

    public function destroy(\App\Models\LearningMaterial $material)
    {
        if ($material->learningGoal->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $goal = $material->learningGoal;
        $material->delete();
        $goal->refreshProgress();

        return back()->with('success', 'Material removed and progress updated!');
    }
=======
        return back()->with('success', 'Material added successfully!');
    }
>>>>>>> origin/main
}

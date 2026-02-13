<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('instructor')->withCount('students')->latest()->paginate(12);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'lecturer') {
            abort(403);
        }
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'lecturer') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => 'required|string|unique:courses,code',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'code' => $request->code,
            'instructor_id' => auth()->id(),
        ]);

        return redirect()->route('courses.show', $course)->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(['instructor', 'topics.user', 'materials']);
        $isEnrolled = $course->students()->where('user_id', auth()->id())->exists();
        $isInstructor = $course->instructor_id === auth()->id();

        return view('courses.show', compact('course', 'isEnrolled', 'isInstructor'));
    }

    /**
     * Store a newly created material in storage.
     */
    public function storeMaterial(Request $request, Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:note,link,file',
            'content' => 'required|string',
        ]);

        $course->materials()->create($request->only(['title', 'type', 'content']));

        return back()->with('success', 'Material added successfully!');
    }

    /**
     * Remove the specified material from storage.
     */
    public function destroyMaterial(Course $course, \App\Models\CourseMaterial $material)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $material->delete();

        return back()->with('success', 'Material removed successfully!');
    }

    public function toggleMaterialComplete(\App\Models\CourseMaterial $material)
    {
        $user = auth()->user();
        
        // Ensure student is enrolled in the course
        if (!$material->course->students()->where('user_id', $user->id)->exists()) {
            abort(403);
        }

        $isCompleted = $user->completedCourseMaterials()->where('course_material_id', $material->id)->exists();

        if ($isCompleted) {
            $user->completedCourseMaterials()->detach($material->id);
            $status = false;
        } else {
            $user->completedCourseMaterials()->attach($material->id);
            $status = true;
        }

        return response()->json([
            'success' => true,
            'is_completed' => $status
        ]);
    }

    /**
     * Handle student enrollment.
     */
    public function enroll(Request $request, Course $course)
    {
        if (auth()->user()->role !== 'student') {
            return back()->with('error', 'Only students can enroll in courses.');
        }

        if ($course->students()->where('user_id', auth()->id())->exists()) {
            return back()->with('info', 'You are already enrolled in this course.');
        }

        $course->students()->attach(auth()->id());

        return back()->with('success', 'You have successfully enrolled in the course!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => 'required|string|unique:courses,code,' . $course->id,
        ]);

        $course->update($request->only(['title', 'description', 'code']));

        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->instructor_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}

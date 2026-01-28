<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Show the forum topics for a course.
     */
    public function index(Course $course)
    {
        $this->authorizeAccess($course);

        $topics = $course->topics()->with('user')->withCount('replies')->latest()->paginate(20);
        return view('forum.index', compact('course', 'topics'));
    }

    /**
     * Show a single forum topic and its replies.
     */
    public function show(Course $course, ForumTopic $topic)
    {
        $this->authorizeAccess($course);
        
        if ($topic->course_id !== $course->id) {
            abort(404);
        }

        $topic->load(['user', 'replies.user']);
        return view('forum.show', compact('course', 'topic'));
    }

    /**
     * Store a new forum topic.
     */
    public function storeTopic(Request $request, Course $course)
    {
        $this->authorizeAccess($course);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $topic = $course->topics()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.show', [$course, $topic])->with('success', 'Topic created successfully!');
    }

    /**
     * Store a new reply to a topic.
     */
    public function storeReply(Request $request, Course $course, ForumTopic $topic)
    {
        $this->authorizeAccess($course);

        if ($topic->course_id !== $course->id) {
            abort(404);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $topic->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Reply posted successfully!');
    }

    /**
     * Private helper to check if user is instructor or enrolled student.
     */
    private function authorizeAccess(Course $course)
    {
        $isInstructor = $course->instructor_id === auth()->id();
        $isEnrolled = $course->students()->where('user_id', auth()->id())->exists();

        if (!$isInstructor && !$isEnrolled && auth()->user()->role !== 'admin') {
            abort(403, 'You must be enrolled in this course to access the forum.');
        }
    }
}

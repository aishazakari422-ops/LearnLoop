<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function students()
    {
        // In a real LMS, there would be a pivot table for lecturer_student.
        // For this project, we'll list all students.
        $students = \App\Models\User::where('role', 'student')
            ->withCount('learningGoals')
            ->latest()
            ->paginate(12);

        return view('lecturer.students', compact('students'));
    }
}

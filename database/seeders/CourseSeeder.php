<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturerId = 2; // Ayeshaa

        $courses = [
            [
                'title' => 'Data Structures and Algorithms',
                'code' => 'CS201',
                'description' => 'Master the fundamental data structures like Arrays, Linked Lists, Trees, and Graphs, along with essential algorithms for searching and sorting.',
                'instructor_id' => $lecturerId,
            ],
            [
                'title' => 'Visual Programming with Laravel',
                'code' => 'CS302',
                'description' => 'Learn to build dynamic and interactive web applications using the powerful Laravel framework, focusing on visual components and user experience.',
                'instructor_id' => $lecturerId,
            ],
            [
                'title' => 'Introduction to Computer Science',
                'code' => 'CS101',
                'description' => 'A foundational course covering the basics of computing, logic, and problem-solving skills essential for any aspiring software developer.',
                'instructor_id' => $lecturerId,
            ],
            [
                'title' => 'Object Oriented Programming',
                'code' => 'CS202',
                'description' => 'Dive deep into the principles of OOP including inheritance, polymorphism, encapsulation, and abstraction using modern programming languages.',
                'instructor_id' => $lecturerId,
            ],
            [
                'title' => 'Database Management Systems',
                'code' => 'CS401',
                'description' => 'Understand how to design, implement, and manage robust relational databases using SQL and industry-standard tools.',
                'instructor_id' => $lecturerId,
            ],
        ];

        foreach ($courses as $course) {
            \App\Models\Course::updateOrCreate(['code' => $course['code']], $course);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = \App\Models\Course::all();

        foreach ($courses as $course) {
            if ($course->code === 'CS201') { // Data Structures
                $course->materials()->create([
                    'title' => 'Lecture 1: Introduction to Arrays',
                    'type' => 'note',
                    'content' => 'Arrays are linear data structures where elements are stored in contiguous memory locations.',
                ]);
                $course->materials()->create([
                    'title' => 'Visualization of Linked Lists',
                    'type' => 'link',
                    'content' => 'https://visualgo.net/en/list',
                ]);
            }

            if ($course->code === 'CS302') { // Visual Programming with Laravel
                $course->materials()->create([
                    'title' => 'Laravel Installation Guide',
                    'type' => 'link',
                    'content' => 'https://laravel.com/docs/installation',
                ]);
                $course->materials()->create([
                    'title' => 'MVC Architecture in Laravel',
                    'type' => 'note',
                    'content' => 'Laravel follows the Model-View-Controller architectural pattern for clean code separation.',
                ]);
            }
        }
    }
}

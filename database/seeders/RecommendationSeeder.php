<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturer = \App\Models\User::where('role', 'lecturer')->first();
        $student = \App\Models\User::where('role', 'student')->first();

        if ($lecturer && $student) {
            \App\Models\Recommendation::create([
                'student_id' => $student->id,
                'lecturer_id' => $lecturer->id,
                'material_title' => 'Advanced Laravel Design Patterns',
                'material_link' => 'https://laravel-news.com/category/design-patterns',
                'note' => 'Since you are doing visual programming with Laravel, these design patterns will help you structure your code better.',
            ]);

            \App\Models\Recommendation::create([
                'student_id' => $student->id,
                'lecturer_id' => $lecturer->id,
                'material_title' => 'Understanding Eloquent Relationships',
                'material_link' => 'https://laravel.com/docs/eloquent-relationships',
                'note' => 'I noticed you are working on complex data structures. This guide on Eloquent is essential.',
            ]);
        }
    }
}

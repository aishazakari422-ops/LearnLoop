<?php

use App\Models\User;
use App\Models\Course;
use App\Models\ForumTopic;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('lecturer can create a course', function () {
    $lecturer = User::factory()->create(['role' => 'lecturer']);

    $response = $this->actingAs($lecturer)->post(route('courses.store'), [
        'title' => 'Test Course',
        'code' => 'T101',
        'description' => 'This is a test course description.',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('courses', ['title' => 'Test Course', 'code' => 'T101']);
});

test('student can enroll in a course', function () {
    $lecturer = User::factory()->create(['role' => 'lecturer']);
    $student = User::factory()->create(['role' => 'student']);
    $course = Course::create([
        'title' => 'Enrollment Test',
        'code' => 'E101',
        'description' => 'Test',
        'instructor_id' => $lecturer->id,
    ]);

    $response = $this->actingAs($student)->post(route('courses.enroll', $course));

    $response->assertRedirect();
    $this->assertTrue($course->students()->where('user_id', $student->id)->exists());
});

test('enrolled student can create a forum topic', function () {
    $lecturer = User::factory()->create(['role' => 'lecturer']);
    $student = User::factory()->create(['role' => 'student']);
    $course = Course::create([
        'title' => 'Forum Test',
        'code' => 'F101',
        'description' => 'Test',
        'instructor_id' => $lecturer->id,
    ]);
    $course->students()->attach($student->id);

    $response = $this->actingAs($student)->post(route('forum.topic.store', $course), [
        'title' => 'How to use Eloquent?',
        'content' => 'I need help with Eloquent relationships.',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('forum_topics', ['title' => 'How to use Eloquent?', 'course_id' => $course->id]);
});

test('student cannot access forum if not enrolled', function () {
    $lecturer = User::factory()->create(['role' => 'lecturer']);
    $student = User::factory()->create(['role' => 'student']);
    $course = Course::create([
        'title' => 'Private Forum Test',
        'code' => 'P101',
        'description' => 'Test',
        'instructor_id' => $lecturer->id,
    ]);

    $response = $this->actingAs($student)->get(route('forum.index', $course));

    $response->assertStatus(403);
});

test('instructor can reply to forum topics', function () {
    $lecturer = User::factory()->create(['role' => 'lecturer']);
    $student = User::factory()->create(['role' => 'student']);
    $course = Course::create([
        'title' => 'Reply Test',
        'code' => 'R101',
        'description' => 'Test',
        'instructor_id' => $lecturer->id,
    ]);
    $topic = ForumTopic::create([
        'course_id' => $course->id,
        'user_id' => $student->id,
        'title' => 'Test Topic',
        'content' => 'Test Content',
    ]);

    $response = $this->actingAs($lecturer)->post(route('forum.reply.store', [$course, $topic]), [
        'content' => 'Here is my reply.',
    ]);

    $response->assertSessionHas('success');
    $this->assertDatabaseHas('forum_replies', ['content' => 'Here is my reply.', 'forum_topic_id' => $topic->id]);
});

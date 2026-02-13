<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearningGoalController;
use App\Http\Controllers\LearningMaterialController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard & App Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Resources
    Route::resource('goals', LearningGoalController::class);
    Route::patch('/materials/{material}/toggle', [LearningMaterialController::class, 'toggleComplete'])->name('materials.toggle');
    Route::resource('materials', LearningMaterialController::class);
    Route::resource('recommendations', RecommendationController::class);
    
    // Course & Forum Routes
    Route::resource('courses', \App\Http\Controllers\CourseController::class);
    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\CourseController::class, 'enroll'])->name('courses.enroll');
    Route::patch('/courses/materials/{material}/toggle', [\App\Http\Controllers\CourseController::class, 'toggleMaterialComplete'])->name('courses.materials.toggle');
    Route::post('/courses/{course}/materials', [\App\Http\Controllers\CourseController::class, 'storeMaterial'])->name('courses.materials.store');
    Route::delete('/courses/{course}/materials/{material}', [\App\Http\Controllers\CourseController::class, 'destroyMaterial'])->name('courses.materials.destroy');
    
    Route::get('/courses/{course}/forum', [\App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::post('/courses/{course}/forum', [\App\Http\Controllers\ForumController::class, 'storeTopic'])->name('forum.topic.store');
    Route::get('/courses/{course}/forum/{topic}', [\App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/courses/{course}/forum/{topic}/reply', [\App\Http\Controllers\ForumController::class, 'storeReply'])->name('forum.reply.store');
    
    // Profile Routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Lecturer Routes
    Route::get('/lecturer/students', [\App\Http\Controllers\LecturerController::class, 'students'])->name('lecturer.students');
    
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    });
});

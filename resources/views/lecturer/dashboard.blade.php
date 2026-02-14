@extends('layouts.app')

@section('title', 'Lecturer Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
<<<<<<< HEAD
    @include('lecturer.sidebar')
=======
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        <a href="{{ route('lecturer.students') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            My Students
        </a>
        <a href="#" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            Recommendations
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            Profile
        </a>
    </aside>
>>>>>>> origin/main

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Lecturer Overview</h3>
            </div>
            <p>Welcome, Lecturer. Here you can track student progress and provide recommendations.</p>
            
            <div style="margin-top: 2rem; padding: 2rem; border: 1px dashed rgba(255,255,255,0.1); text-align: center; border-radius: 8px;">
                <p class="text-muted">Student progress tracking module coming soon.</p>
            </div>
        </div>
    </div>
</div>
@endsection

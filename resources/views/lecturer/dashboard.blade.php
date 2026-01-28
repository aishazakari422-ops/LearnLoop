@extends('layouts.app')

@section('title', 'Lecturer Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('lecturer.sidebar')

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

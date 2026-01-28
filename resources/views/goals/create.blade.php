@extends('layouts.app')

@section('title', 'Create Goal - LearnLoop')

@section('content')
<div class="dashboard-grid">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        <a href="{{ route('goals.create') }}" class="sidebar-link active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            Add New Goal
        </a>
        <a href="{{ route('materials.index') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            My Materials
        </a>
    </aside>

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Create New Learning Goal</h3>
            </div>

            <form method="POST" action="{{ route('goals.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Goal Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Master Laravel Framework" required>
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe what you want to achieve..."></textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="target_date" class="form-label">Target Completion Date</label>
                        <input type="date" name="target_date" id="target_date" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Goal</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline" style="margin-left: 1rem;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

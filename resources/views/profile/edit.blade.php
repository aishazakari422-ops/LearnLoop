@extends('layouts.app')

@section('title', 'My Profile - LearnLoop')

@section('content')
<div class="dashboard-grid">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        @if(auth()->user()->role === 'student')
        <a href="{{ route('goals.create') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            Add New Goal
        </a>
        <a href="{{ route('materials.index') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            My Materials
        </a>
        @endif
        <a href="{{ route('profile.edit') }}" class="sidebar-link active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            Profile
        </a>
    </aside>

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Profile Settings</h3>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                    <!-- User Info Section -->
                    <div>
                        <h4 style="margin-bottom: 1rem; color: var(--accent);">Personal Information</h4>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled style="opacity: 0.7; cursor: not-allowed;">
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 2rem;">
                        <h4 style="margin-bottom: 1rem; color: var(--accent);">Change Password</h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Leave blank if you don't want to change your password.</p>

                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                            @error('current_password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                                @error('new_password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

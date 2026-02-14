@extends('layouts.app')

@section('title', 'Admin Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
<<<<<<< HEAD
    @include('admin.sidebar')
=======
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            Manage Users
        </a>
        <a href="#" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            System Reports
        </a>
    </aside>
>>>>>>> origin/main

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Admin Overview</h3>
            </div>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
<<<<<<< HEAD
                <div style="background: rgba(99, 102, 241, 0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(99, 102, 241, 0.2);">
                    <h4 style="font-size: 2rem; color: var(--primary); margin-bottom: 0.25rem;">{{ $stats['total_users'] }}</h4>
                    <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600; text-uppercase: uppercase; letter-spacing: 0.5px;">Total Users</p>
                </div>
                <div style="background: rgba(16, 185, 129, 0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.2);">
                    <h4 style="font-size: 2rem; color: #10b981; margin-bottom: 0.25rem;">{{ $stats['total_courses'] }}</h4>
                    <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600; text-uppercase: uppercase; letter-spacing: 0.5px;">Total Courses</p>
                </div>
                <div style="background: rgba(245, 158, 11, 0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(245, 158, 11, 0.2);">
                    <h4 style="font-size: 2rem; color: #f59e0b; margin-bottom: 0.25rem;">{{ $stats['total_topics'] }}</h4>
                    <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600; text-uppercase: uppercase; letter-spacing: 0.5px;">Forum Discussions</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <h4 style="margin-bottom: 1rem;">Recently Joined Users</h4>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach($recent_users as $user)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
                            <div>
                                <div style="font-weight: 600;">{{ $user->name }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">{{ $user->email }}</div>
                            </div>
                            <span class="badge" style="background: rgba(255,255,255,0.1); color: white; text-transform: capitalize; padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.75rem;">{{ $user->role }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h4 style="margin-bottom: 1rem;">Latest Courses</h4>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach($recent_courses as $course)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
                            <div>
                                <div style="font-weight: 600;">{{ $course->title }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">By {{ $course->instructor->name }}</div>
                            </div>
                            <span style="font-family: monospace; font-size: 0.8rem; background: var(--primary); color: white; padding: 0.15rem 0.4rem; border-radius: 3px;">{{ $course->code }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
=======
                <div style="background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 8px; text-align: center;">
                    <h4 style="font-size: 2rem; color: var(--primary); margin-bottom: 0.5rem;">{{ \App\Models\User::count() }}</h4>
                    <p style="color: var(--text-muted);">Total Users</p>
                </div>
                <div style="background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 8px; text-align: center;">
                    <h4 style="font-size: 2rem; color: var(--accent); margin-bottom: 0.5rem;">{{ \App\Models\LearningGoal::count() }}</h4>
                    <p style="color: var(--text-muted);">Active Goals</p>
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <h4>Recent Activity</h4>
                <p class="text-muted">System logs and activity tracking module.</p>
>>>>>>> origin/main
            </div>
        </div>
    </div>
</div>
@endsection

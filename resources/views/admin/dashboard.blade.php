@extends('layouts.app')

@section('title', 'Admin Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('admin.sidebar')

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Admin Overview</h3>
            </div>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
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
            </div>
        </div>
    </div>
</div>
@endsection

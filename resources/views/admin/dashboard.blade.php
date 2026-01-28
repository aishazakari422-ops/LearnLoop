@extends('layouts.app')

@section('title', 'Admin Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
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

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Admin Overview</h3>
            </div>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
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
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Manage Users - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('admin.sidebar')

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>All Users</h3>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                        <th style="padding: 1.25rem 1rem;">User Info</th>
                        <th style="padding: 1.25rem 1rem;">Role</th>
                        <th style="padding: 1.25rem 1rem;">Manage Role</th>
                        <th style="padding: 1.25rem 1rem; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1rem;">
                            <div style="font-weight: 600; color: white;">{{ $user->name }}</div>
                            <div style="font-size: 0.85rem; color: var(--text-muted);">{{ $user->email }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">Joined: {{ $user->created_at->format('M d, Y') }}</div>
                        </td>
                        <td style="padding: 1.25rem 1rem;">
                            <span class="badge" style="background: {{ $user->role === 'admin' ? 'rgba(99, 102, 241, 0.2)' : ($user->role === 'lecturer' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(255, 255, 255, 0.1)') }}; 
                                color: {{ $user->role === 'admin' ? 'var(--primary)' : ($user->role === 'lecturer' ? '#10b981' : 'white') }}; 
                                text-transform: capitalize; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600;">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td style="padding: 1.25rem 1rem;">
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.role', $user) }}" method="POST" style="display: flex; gap: 0.5rem;">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-control" style="padding: 0.4rem; font-size: 0.85rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="lecturer" {{ $user->role === 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Update</button>
                            </form>
                            @else
                            <span style="font-size: 0.85rem; color: var(--text-muted); font-style: italic;">(Current Session)</span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem 1rem; text-align: right;">
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="border-color: #ef4444; color: #ef4444; padding: 0.4rem 0.8rem; font-size: 0.85rem;" 
                                        onmouseover="this.style.background='#ef4444'; this.style.color='white'" 
                                        onmouseout="this.style.background='transparent'; this.style.color='#ef4444'">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="margin-top: 1rem;">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

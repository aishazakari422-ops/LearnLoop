@extends('layouts.app')

@section('title', 'Manage Courses - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('admin.sidebar')

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>All Courses</h3>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                        <th style="padding: 1.25rem 1rem;">Course Info</th>
                        <th style="padding: 1.25rem 1rem;">Instructor</th>
                        <th style="padding: 1.25rem 1rem;">Stats</th>
                        <th style="padding: 1.25rem 1rem; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1rem;">
                            <div style="font-weight: 600; color: white;">{{ $course->title }}</div>
                            <div style="font-family: monospace; font-size: 0.85rem; color: var(--primary); margin-top: 0.2rem;">{{ $course->code }}</div>
                        </td>
                        <td style="padding: 1.25rem 1rem;">
                            <div style="font-size: 0.9rem;">{{ $course->instructor->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $course->instructor->email }}</div>
                        </td>
                        <td style="padding: 1.25rem 1rem;">
                            <span style="font-size: 0.85rem; color: var(--text-muted);">
                                <strong>{{ $course->students_count }}</strong> Students
                            </span>
                        </td>
                        <td style="padding: 1.25rem 1rem; text-align: right;">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">View</a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="border-color: #ef4444; color: #ef4444; padding: 0.4rem 0.8rem; font-size: 0.85rem;"
                                        onmouseover="this.style.background='#ef4444'; this.style.color='white'" 
                                        onmouseout="this.style.background='transparent'; this.style.color='#ef4444'">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="margin-top: 1rem;">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

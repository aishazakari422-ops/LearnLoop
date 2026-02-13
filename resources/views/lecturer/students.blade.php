@extends('layouts.app')

@section('title', 'My Students - LearnLoop')

@section('content')
<div class="dashboard-grid">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        <a href="{{ route('lecturer.students') }}" class="sidebar-link active">
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

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>My Students Overview</h3>
            </div>

            @if($students->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.05);">
                                <th style="text-align: left; padding: 1rem; color: var(--text-muted); font-size: 0.9rem;">Name</th>
                                <th style="text-align: left; padding: 1rem; color: var(--text-muted); font-size: 0.9rem;">Email</th>
                                <th style="text-align: center; padding: 1rem; color: var(--text-muted); font-size: 0.9rem;">Goals Set</th>
                                <th style="text-align: right; padding: 1rem; color: var(--text-muted); font-size: 0.9rem;">Joined</th>
                                <th style="text-align: right; padding: 1rem; color: var(--text-muted); font-size: 0.9rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;">
                                    <td style="padding: 1rem; font-weight: 600;">{{ $student->name }}</td>
                                    <td style="padding: 1rem;">{{ $student->email }}</td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <span style="background: rgba(99, 102, 241, 0.2); color: var(--primary); padding: 0.25rem 0.5rem; border-radius: 99px; font-size: 0.8rem;">
                                            {{ $student->learning_goals_count }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; text-align: right; color: var(--text-muted);">{{ $student->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 1rem; text-align: right;">
                                        <button class="btn btn-primary" style="padding: 0.25rem 0.75rem; font-size: 0.8rem;" 
                                            data-toggle="modal" 
                                            data-target="#recommendModal" 
                                            onclick="setStudentId({{ $student->id }}, '{{ $student->name }}')">
                                            Recommend
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Recommendation Modal -->
                <div class="modal fade" id="recommendModal" tabindex="-1" role="dialog" aria-labelledby="recommendModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content border-0 shadow-lg" style="background: var(--card-bg); color: var(--text-main);">
                            <form action="{{ route('recommendations.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" id="modal_student_id">
                                <div class="modal-header border-0 pt-4 px-4">
                                    <h5 class="modal-title font-weight-bold" id="recommendModalLabel">Recommend to <span id="modal_student_name"></span></h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Material Title</label>
                                        <input type="text" name="material_title" class="form-control" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;" placeholder="e.g., Advanced React Hooks Guide" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Resource Link (Optional)</label>
                                        <input type="url" name="material_link" class="form-control" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;" placeholder="https://...">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Personal Note (Optional)</label>
                                        <textarea name="note" class="form-control" rows="3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;" placeholder="Why are you recommending this?"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pb-4 px-4">
                                    <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary px-4">Send Recommendation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    function setStudentId(id, name) {
                        document.getElementById('modal_student_id').value = id;
                        document.getElementById('modal_student_name').innerText = name;
                    }
                </script>
                
                <div style="margin-top: 2rem;">
                    {{ $students->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 4rem 2rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3>No Students Found</h3>
                    <p>There are no students registered in the system yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Recommendations - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('student.sidebar')

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>{{ auth()->user()->role === 'student' ? 'Recommended for You' : 'Recommendations Sent' }}</h3>
                <p class="text-muted small mb-0">
                    {{ auth()->user()->role === 'student' 
                        ? 'Learning materials and resources suggested by your instructors.' 
                        : 'Resources and materials you have suggested to your students.' }}
                </p>
            </div>

            @if($recommendations->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
                    @foreach($recommendations as $rec)
                        <div style="background: var(--card-bg); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 1.5rem; transition: var(--transition); border-left: 4px solid var(--primary);">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                <h4 style="font-size: 1.125rem; margin-bottom: 0;">{{ $rec->material_title }}</h4>
                                <form action="{{ route('recommendations.destroy', $rec) }}" method="POST" onsubmit="return confirm('Remove this recommendation?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0.25rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </form>
                            </div>

                            @if($rec->note)
                                <p style="font-size: 0.95rem; color: var(--text-main); margin-bottom: 1rem; line-height: 1.5;">{{ $rec->note }}</p>
                            @endif

                            <div style="margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    @if(auth()->user()->role === 'student')
                                        <div style="width: 32px; height: 32px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color: white;">
                                            {{ strtoupper(substr($rec->lecturer->name, 0, 1)) }}
                                        </div>
                                        <div style="font-size: 0.85rem;">
                                            <div style="font-weight: 600;">{{ $rec->lecturer->name }}</div>
                                            <small class="text-muted">{{ $rec->created_at->diffForHumans() }}</small>
                                        </div>
                                    @else
                                        <div style="width: 32px; height: 32px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color: white;">
                                            {{ strtoupper(substr($rec->student->name, 0, 1)) }}
                                        </div>
                                        <div style="font-size: 0.85rem;">
                                            <div style="font-weight: 600;">To: {{ $rec->student->name }}</div>
                                            <small class="text-muted">{{ $rec->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($rec->material_link)
                                    <a href="{{ $rec->material_link }}" target="_blank" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Explore Resource →</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 5rem 2rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <h3>Your recommendation list is empty</h3>
                    <p>When instructors suggest learning materials, they will appear here.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

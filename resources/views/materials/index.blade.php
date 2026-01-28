@extends('layouts.app')

@section('title', 'My Materials - LearnLoop')

@section('content')
<div class="dashboard-grid">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            Dashboard
        </a>
        <a href="{{ route('goals.create') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            Add New Goal
        </a>
        <a href="{{ route('materials.index') }}" class="sidebar-link active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            My Materials
        </a>
    </aside>

    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>All Learning Materials</h3>
            </div>

            @if($materials->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
                    @foreach($materials as $material)
                        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; padding: 1.5rem; transition: all 0.3s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                <div style="color: var(--primary);">
                                    @if($material->type == 'video')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                    @elseif($material->type == 'pdf')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                    @endif
                                </div>
                                <span style="font-size: 0.75rem; padding: 0.25rem 0.5rem; background: rgba(255,255,255,0.1); border-radius: 4px;">{{ strtoupper($material->type) }}</span>
                            </div>

                            <h4 style="margin-bottom: 0.5rem; font-size: 1.1rem; min-height: 2.8em; line-height: 1.4;">{{ Str::limit($material->title, 40) }}</h4>
                            
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                                Goal: {{ Str::limit($material->learningGoal->title, 30) }}
                            </p>

                            <a href="{{ $material->content_url }}" target="_blank" class="btn btn-outline" style="width: 100%; text-align: center; font-size: 0.9rem;">Open Resource</a>
                        </div>
                    @endforeach
                </div>
                
                <div style="margin-top: 2rem;">
                    {{ $materials->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 4rem 2rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    </div>
                    <h3>No Materials Found</h3>
                    <p style="margin-bottom: 1.5rem;">Add learning materials to your goals to see them here.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

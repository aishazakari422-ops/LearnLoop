@extends('layouts.app')

@section('title', 'Dashboard - LearnLoop')

@section('content')
<div class="dashboard-grid">
    @include('student.sidebar')

    <div class="main-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>My Learning Goals</h3>
                        <a href="{{ route('goals.create') }}" class="btn btn-primary" style="font-size: 0.9rem;">+ New Goal</a>
                    </div>

                    @if(isset($goals) && count($goals) > 0)
                        <div style="display: grid; gap: 1rem;">
                            @foreach($goals as $goal)
                                <div style="background: rgba(255,255,255,0.03); padding: 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                                    <div style="display: flex; justify-content: space-between; align-items: start;">
                                        <div>
                                            <h4 style="margin-bottom: 0.5rem;">{{ $goal->title }}</h4>
                                            <p style="font-size: 0.9rem; margin-bottom: 0.5rem;">{{ Str::limit($goal->description, 100) }}</p>
                                            <div style="font-size: 0.8rem; color: var(--text-muted);">
                                                Target: {{ $goal->target_date ? $goal->target_date->format('M d, Y') : 'No Date' }}
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <span style="display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; background: rgba(6, 182, 212, 0.2); color: var(--accent); font-size: 0.8rem; margin-bottom: 0.5rem;">
                                                {{ ucfirst($goal->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top: 1rem;">
                                        <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.25rem;">
                                            <span>Progress</span>
                                            <span>{{ $goal->progress->percentage ?? 0 }}%</span>
                                        </div>
                                        <div style="width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; overflow: hidden;">
                                            <div style="width: {{ $goal->progress->percentage ?? 0 }}%; height: 100%; background: var(--primary);"></div>
                                        </div>
                                    </div>

                                    <div style="margin-top: 1rem; display: flex; gap: 0.5rem;">
                                        <a href="{{ route('goals.show', $goal->id) }}" class="btn btn-outline" style="padding: 0.25rem 0.75rem; font-size: 0.8rem;">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            <p>You haven't set any learning goals yet.</p>
                            <a href="{{ route('goals.create') }}" style="color: var(--primary); margin-top: 0.5rem; display: inline-block;">Start your first goal</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Recommended</h3>
                    </div>
                    @forelse($recommendations as $rec)
                        <div style="background: rgba(99, 102, 241, 0.05); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 3px solid var(--primary);">
                            <h5 style="margin-bottom: 0.5rem; font-size: 1rem;">{{ $rec->material_title }}</h5>
                            @if($rec->note)
                                <p style="font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-main);">{{ $rec->note }}</p>
                            @endif
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
                                <small style="color: var(--text-muted);">By {{ $rec->lecturer->name }}</small>
                                @if($rec->material_link)
                                    <a href="{{ $rec->material_link }}" target="_blank" class="text-primary small" style="font-weight: 600;">View →</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.9rem;">
                            No recommendations yet.
                        </div>
                    @endforelse
                    
                    @if($recommendations->count() > 0)
                        <div style="text-align: center; margin-top: 0.5rem;">
                            <a href="{{ route('recommendations.index') }}" style="font-size: 0.85rem; color: var(--text-muted);">View all recommendations</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

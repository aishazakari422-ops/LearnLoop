@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 font-weight-bold text-dark mb-0">Courses</h2>
                @if(auth()->user()->role === 'lecturer')
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">Create New Course</a>
                @endif
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($courses as $course)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge badge-soft-primary">{{ $course->code }}</span>
                                    <small class="text-muted">{{ $course->students_count }} Students</small>
                                </div>
                                <h5 class="card-title font-weight-bold">{{ $course->title }}</h5>
                                <p class="card-text text-muted small mb-4">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                                <div class="d-flex align-items-center mt-auto">
                                    <div class="avatar-sm mr-2" style="width: 32px; height: 32px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color: #4f46e5;">
                                        {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                                    </div>
                                    <small class="text-dark font-weight-medium">{{ $course->instructor->name }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary btn-block">View Course</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No courses available yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

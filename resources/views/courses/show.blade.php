@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge badge-soft-primary mb-2">{{ $course->code }}</span>
                            <h2 class="h3 font-weight-bold text-dark">{{ $course->title }}</h2>
                        </div>
                        <div class="d-flex gap-2">
                            @if($isInstructor)
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-primary btn-sm">Edit Course</a>
                            @endif

                            @if(!$isInstructor && !$isEnrolled && auth()->user()->role === 'student')
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Enroll Now</button>
                                </form>
                            @elseif($isEnrolled)
                                <span class="badge badge-soft-success pt-2">Enrolled</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar-sm mr-2" style="width: 40px; height: 40px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; color: #4f46e5;">
                            {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-dark font-weight-bold">{{ $course->instructor->name }}</div>
                            <small class="text-muted">Course Instructor</small>
                        </div>
                    </div>

                    <div class="course-description mb-4">
                        <h4 class="h6 font-weight-bold text-dark text-uppercase letter-spacing-wider mb-2">About this Course</h4>
                        <p class="text-muted leading-relaxed">
                            {{ $course->description }}
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="h5 font-weight-bold text-dark mb-1">Course Forum</h4>
                            <p class="text-muted small mb-0">Join the discussion with other students and the instructor.</p>
                        </div>
                        @if($isInstructor || $isEnrolled || auth()->user()->role === 'admin')
                            <a href="{{ route('forum.index', $course) }}" class="btn btn-primary">Go to Forum</a>
                        @else
                            <button class="btn btn-secondary" disabled>Enroll to access Forum</button>
                        @endif
                    </div>
                </div>
            </div>

            @if($isInstructor || $isEnrolled || auth()->user()->role === 'admin')
            <div class="row mb-4">
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h3 class="h5 font-weight-bold text-dark mb-0">Course Materials</h3>
                            @if($isInstructor)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addMaterialModal">
                                    + Add Material
                                </button>
                            @endif
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="list-group list-group-flush">
                                @forelse($course->materials as $material)
                                    <div class="list-group-item px-0 py-3 border-0 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="d-flex align-items-start">
                                                <div class="mr-3 mt-1">
                                                    @if($material->type === 'note')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                    @elseif($material->type === 'link')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5 class="h6 font-weight-bold mb-1 text-dark">{{ $material->title }}</h5>
                                                    <div class="text-muted small">
                                                        @if($material->type === 'link')
                                                            <a href="{{ $material->content }}" target="_blank" class="text-primary">{{ $material->content }}</a>
                                                        @else
                                                            {{ $material->content }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if($isInstructor)
                                                <form action="{{ route('courses.materials.destroy', [$course, $material]) }}" method="POST" onsubmit="return confirm('Delete this material?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-4 text-center text-muted">
                                        No materials have been added to this course yet.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h3 class="h5 font-weight-bold text-dark mb-0">Recent Forum Activity</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @forelse($course->topics->take(5) as $topic)
                                    <a href="{{ route('forum.show', [$course, $topic]) }}" class="list-group-item list-group-item-action p-3 border-0 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h5 class="small font-weight-bold mb-0 text-dark">{{ $topic->title }}</h5>
                                            <small class="text-muted">{{ $topic->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">By {{ $topic->user->name }}</small>
                                            <span class="badge badge-pill badge-light">{{ $topic->replies_count ?? 0 }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-muted small">
                                        No forum topics yet.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        @if($course->topics->count() > 0)
                            <div class="card-footer bg-white border-0 text-center pb-3">
                                <a href="{{ route('forum.index', $course) }}" class="text-primary font-weight-medium small">View All Topics →</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            @if($isInstructor)
            <!-- Add Material Modal -->
            <div class="modal fade" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0 shadow-lg">
                        <form action="{{ route('courses.materials.store', $course) }}" method="POST">
                            @csrf
                            <div class="modal-header border-0 pt-4 px-4">
                                <h5 class="modal-title font-weight-bold text-dark" id="addMaterialModalLabel">Add Course Material</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="e.g., Week 1: Introduction to Data Structures" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="note">Note / Text</option>
                                        <option value="link">External Link</option>
                                        <option value="file">File / Doc URL</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-muted small text-uppercase letter-spacing-wider">Content / URL</label>
                                    <textarea name="content" class="form-control" rows="4" placeholder="Enter the note content, website link, or file URL..." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pb-4 px-4">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Save Material</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('forum.index', $course) }}">Forum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($topic->title, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <!-- Original Topic -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar-md mr-3" style="width: 48px; height: 48px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; color: #4f46e5;">
                            {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="h5 font-weight-bold text-dark mb-0">{{ $topic->user->name }}</h4>
                            <small class="text-muted">Posted {{ $topic->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <h2 class="h3 font-weight-bold text-dark mb-3">{{ $topic->title }}</h2>
                    <div class="topic-content prose max-w-none text-dark leading-relaxed">
                        {!! nl2br(e($topic->content)) !!}
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="replies-section mb-4">
                <h4 class="h5 font-weight-bold text-dark mb-4">{{ $topic->replies->count() }} Replies</h4>
                
                @foreach($topic->replies as $reply)
                    <div class="card shadow-sm border-0 mb-3 ml-md-5">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm mr-2" style="width: 32px; height: 32px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; color: #64748b;">
                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-dark font-weight-bold small">{{ $reply->user->name }}</span>
                                    @if($reply->user_id === $course->instructor_id)
                                        <span class="badge badge-soft-primary px-2" style="font-size: 10px;">Instructor</span>
                                    @endif
                                    <small class="text-muted">• {{ $reply->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="reply-content text-dark-75 small leading-relaxed">
                                {!! nl2br(e($reply->content)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold text-dark mb-3">Your Reply</h5>
                    <form action="{{ route('forum.reply.store', [$course, $topic]) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea name="content" id="reply_content" rows="4" class="form-control" placeholder="Share your thoughts or answer the question..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">Post Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-4 sticky-top" style="top: 2rem;">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold text-dark mb-4">Forum Guidelines</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <span class="text-primary mr-2">✓</span>
                            <small class="text-muted">Be respectful and professional.</small>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <span class="text-primary mr-2">✓</span>
                            <small class="text-muted">Check if your question has already been answered.</small>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <span class="text-primary mr-2">✓</span>
                            <small class="text-muted">Stay on topic related to the course.</small>
                        </li>
                        <li class="d-flex align-items-start">
                            <span class="text-primary mr-2">✓</span>
                            <small class="text-muted">Use code snippets where appropriate.</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

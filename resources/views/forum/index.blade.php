@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 font-weight-bold text-dark mb-0">Discussion Forum</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTopicModal">
                    Start New Topic
                </button>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($topics as $topic)
                            <div class="list-group-item p-4 border-0 border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-md" style="width: 48px; height: 48px; background: #eef2ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; color: #4f46e5;">
                                            {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="h6 font-weight-bold mb-1">
                                            <a href="{{ route('forum.show', [$course, $topic]) }}" class="text-dark hover-primary">{{ $topic->title }}</a>
                                        </h5>
                                        <div class="d-flex align-items-center gap-3">
                                            <small class="text-muted">By <span class="text-dark font-weight-medium">{{ $topic->user->name }}</span></small>
                                            <small class="text-muted">•</small>
                                            <small class="text-muted">{{ $topic->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="col-auto text-right">
                                        <div class="text-center px-3 py-2 bg-light rounded">
                                            <div class="h6 font-weight-bold mb-0 text-dark">{{ $topic->replies_count }}</div>
                                            <small class="text-muted text-uppercase letter-spacing-wider" style="font-size: 10px;">Replies</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center">
                                <img src="/img/empty-forum.svg" alt="Empty Forum" class="mb-3" style="width: 120px; opacity: 0.5;">
                                <h5 class="text-dark font-weight-bold">No topics yet</h5>
                                <p class="text-muted mb-4">Start a discussion to get help or share ideas with your peers.</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTopicModal">
                                    Post a Question
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-4">
                    {{ $topics->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Topic Modal -->
<div class="modal fade" id="newTopicModal" tabindex="-1" role="dialog" aria-labelledby="newTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-white border-0 px-4 pt-4">
                <h5 class="modal-title font-weight-bold text-dark" id="newTopicModalLabel">Start a New Discussion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('forum.topic.store', $course) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label font-weight-medium">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="What's on your mind?" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="content" class="form-label font-weight-medium">Content</label>
                        <textarea name="content" id="content" rows="6" class="form-control" placeholder="Provide details about your question or topic..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 p-4">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Post Discussion</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

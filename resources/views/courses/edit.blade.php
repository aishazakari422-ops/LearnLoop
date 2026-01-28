@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h2 class="h4 font-weight-bold text-dark mb-0">Edit Course: {{ $course->title }}</h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-medium">Course Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="code" class="form-label font-weight-medium">Course Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $course->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label font-weight-medium">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="button" class="btn btn-outline-danger" onclick="if(confirm('Are you sure you want to delete this course? This action cannot be undone.')) document.getElementById('delete-course-form').submit();">Delete Course</button>
                            <div class="d-flex gap-2">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">Update Course</button>
                            </div>
                        </div>
                    </form>

                    <form id="delete-course-form" action="{{ route('courses.destroy', $course) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

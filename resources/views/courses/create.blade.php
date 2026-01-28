@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h2 class="h4 font-weight-bold text-dark mb-0">Create New Course</h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-medium">Course Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. Advanced Laravel Development" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="code" class="form-label font-weight-medium">Course Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="e.g. CS101" value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label font-weight-medium">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Describe what students will learn in this course..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('courses.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Create Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

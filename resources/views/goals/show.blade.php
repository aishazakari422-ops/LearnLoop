@extends('layouts.app')

@section('title', $goal->title . ' - LearnLoop')

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
        <a href="{{ route('materials.index') }}" class="sidebar-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            My Materials
        </a>
    </aside>

    <div class="main-content">
        <!-- Goal Header & Progress -->
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 style="margin-bottom: 0.5rem;">{{ $goal->title }}</h2>
                    <p class="text-muted">{{ $goal->description }}</p>
                </div>
                <div style="text-align: right;">
                    <span style="display: inline-block; padding: 0.25rem 0.5rem; border-radius: 4px; background: rgba(99, 102, 241, 0.2); color: var(--primary); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        {{ ucfirst($goal->status) }}
                    </span>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        Starts: {{ $goal->start_date ? $goal->start_date->format('M d, Y') : 'N/A' }}
                    </div>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        Target: {{ $goal->target_date ? $goal->target_date->format('M d, Y') : 'N/A' }}
                    </div>
                </div>
            </div>

            <div style="margin-top: 1rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
<<<<<<< HEAD
                <h4 style="margin-bottom: 1rem;">Goal Progress</h4>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                    <div style="flex: 1; height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
                        <div id="goal-progress-bar" style="width: {{ $goal->progress->percentage ?? 0 }}%; height: 100%; background: var(--primary); transition: width 0.5s ease;"></div>
                    </div>
                    <span id="goal-progress-percent" style="font-weight: 700; color: var(--primary); min-width: 3rem; text-align: right;">{{ $goal->progress->percentage ?? 0 }}%</span>
                </div>
                <p class="text-muted small">Progress is automatically calculated as you mark materials as done.</p>
=======
                <h4 style="margin-bottom: 1rem;">Current Progress</h4>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1; height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
                        <div style="width: {{ $goal->progress->percentage ?? 0 }}%; height: 100%; background: var(--primary);"></div>
                    </div>
                    <span style="font-weight: 700; color: var(--primary);">{{ $goal->progress->percentage ?? 0 }}%</span>
                </div>

                <form action="{{ route('goals.update', $goal->id) }}" method="POST" style="display: flex; gap: 1rem; align-items: flex-end;">
                    @csrf
                    @method('PUT')
                    
                    <div style="flex: 1;">
                        <label for="percentage" class="form-label">Update Progress (%)</label>
                        <input type="number" name="percentage" id="percentage" class="form-control" min="0" max="100" value="{{ $goal->progress->percentage ?? 0 }}">
                    </div>
                    <button type="submit" class="btn btn-outline" style="padding: 0.75rem 1rem;">Update</button>
                </form>
>>>>>>> origin/main
            </div>
        </div>

        <!-- Materials Section -->
        <div class="card">
            <div class="card-header">
                <h3>Learning Materials</h3>
            </div>

            <div style="margin-bottom: 2rem;">
                @if($goal->materials->count() > 0)
                    <div style="display: grid; gap: 1rem;">
                        @foreach($goal->materials as $material)
<<<<<<< HEAD
                            <div style="display: flex; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border-left: 3px solid {{ $material->is_completed ? 'var(--primary)' : 'transparent' }}; transition: border-color 0.3s; opacity: {{ $material->is_completed ? '0.8' : '1' }};" id="material-{{ $material->id }}">
                                <div style="margin-right: 1rem;">
                                    <button class="btn-toggle-complete" 
                                            onclick="toggleMaterial({{ $material->id }})"
                                            style="background: {{ $material->is_completed ? 'var(--primary)' : 'rgba(255,255,255,0.05)' }}; border: 1px solid {{ $material->is_completed ? 'var(--primary)' : 'rgba(255,255,255,0.2)' }}; color: {{ $material->is_completed ? 'white' : 'var(--text-muted)' }}; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </button>
                                </div>
=======
                            <div style="display: flex; align-items: center; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 8px;">
>>>>>>> origin/main
                                <div style="margin-right: 1rem; color: var(--accent);">
                                    @if($material->type == 'video')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                    @elseif($material->type == 'pdf')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                    @endif
                                </div>
                                <div style="flex: 1;">
<<<<<<< HEAD
                                    <h5 style="margin-bottom: 0.25rem; {{ $material->is_completed ? 'text-decoration: line-through; color: var(--text-muted);' : '' }}" id="title-{{ $material->id }}">{{ $material->title }}</h5>
                                    <a href="{{ $material->content_url }}" target="_blank" style="color: var(--primary); font-size: 0.9rem;">{{ Str::limit($material->content_url, 40) }}</a>
                                </div>
                                <div style="margin-right: 1rem;">
                                    <span style="font-size: 0.8rem; padding: 0.25rem 0.5rem; background: rgba(255,255,255,0.1); border-radius: 4px;">{{ strtoupper($material->type) }}</span>
                                </div>
                                <form action="{{ route('materials.destroy', $material) }}" method="POST" onsubmit="return confirm('Remove this material?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.5rem; opacity: 0.6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </form>
=======
                                    <h5 style="margin-bottom: 0.25rem;">{{ $material->title }}</h5>
                                    <a href="{{ $material->content_url }}" target="_blank" style="color: var(--primary); font-size: 0.9rem;">{{ Str::limit($material->content_url, 40) }}</a>
                                </div>
                                <div>
                                    <span style="font-size: 0.8rem; padding: 0.25rem 0.5rem; background: rgba(255,255,255,0.1); border-radius: 4px;">{{ strtoupper($material->type) }}</span>
                                </div>
>>>>>>> origin/main
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); text-align: center; padding: 1rem;">No materials added yet.</p>
                @endif
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
                <h4>Add New Material</h4>
                <form id="upload-form" action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="learning_goal_id" value="{{ $goal->id }}">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="material_title" class="form-label">Title</label>
                            <input type="text" name="title" id="material_title" class="form-control" placeholder="e.g. Intro to Hooks" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="material_type" class="form-label">Type</label>
                            <select name="type" id="material_type" class="form-control" required onchange="toggleMaterialInput()">
                                <option value="link">Website Link</option>
                                <option value="video">Video URL</option>
                                <option value="pdf">File Upload (PDF, Video, Doc)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="url_input_group">
                        <label for="content_url" class="form-label">URL / Link</label>
                        <input type="url" name="content_url" id="content_url" class="form-control" placeholder="https://...">
                    </div>

                    <div class="form-group" id="file_input_group" style="display: none;">
                        <label for="file_upload" class="form-label">Upload File</label>
                        <input type="file" name="file" id="file_upload" class="form-control" accept=".pdf,.doc,.docx,.txt,.mp4,.avi">
                        <small style="color: var(--text-muted);">Max size: 1GB.</small>
                        
                        <!-- Progress Bar -->
                        <div id="progress-container" style="display: none; margin-top: 1rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.5rem; color: var(--text-muted);">
                                <span>Uploading...</span>
                                <span id="progress-percent">0%</span>
                            </div>
                            <div style="width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; overflow: hidden;">
                                <div id="progress-bar" style="width: 0%; height: 100%; background: var(--primary); transition: width 0.2s;"></div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-primary" style="width: 100%;">Add Material</button>
                </form>

                <script>
<<<<<<< HEAD
                    function toggleMaterial(id) {
                        const btn = document.querySelector(`#material-${id} .btn-toggle-complete`);
                        const row = document.getElementById(`material-${id}`);
                        const title = document.getElementById(`title-${id}`);
                        
                        window.axios.patch(`/materials/${id}/toggle`)
                            .then(response => {
                                if (response.data.success) {
                                    const isDone = response.data.is_completed;
                                    
                                    // Update Button UI
                                    btn.style.background = isDone ? 'var(--primary)' : 'rgba(255,255,255,0.05)';
                                    btn.style.borderColor = isDone ? 'var(--primary)' : 'rgba(255,255,255,0.2)';
                                    btn.style.color = isDone ? 'white' : 'var(--text-muted)';
                                    
                                    // Update Row UI
                                    row.style.borderColor = isDone ? 'var(--primary)' : 'transparent';
                                    row.style.opacity = isDone ? '0.8' : '1';
                                    title.style.textDecoration = isDone ? 'line-through' : 'none';
                                    title.style.color = isDone ? 'var(--text-muted)' : 'white';
                                    
                                    // Update Goal Progress Bar
                                    const percentage = response.data.percentage;
                                    document.getElementById('goal-progress-bar').style.width = percentage + '%';
                                    document.getElementById('goal-progress-percent').innerText = percentage + '%';
                                    
                                    if(window.showToast) window.showToast(isDone ? 'Material marked as done!' : 'Material marked as pending.', 'success');
                                }
                            })
                            .catch(error => {
                                console.error('Error toggling material:', error);
                                if(window.showToast) window.showToast('Failed to update progress.', 'error');
                            });
                    }

=======
>>>>>>> origin/main
                    function toggleMaterialInput() {
                        const type = document.getElementById('material_type').value;
                        const urlGroup = document.getElementById('url_input_group');
                        const fileGroup = document.getElementById('file_input_group');
                        const urlInput = document.getElementById('content_url');
                        const fileInput = document.getElementById('file_upload');

                        if (type === 'pdf') {
                            urlGroup.style.display = 'none';
                            fileGroup.style.display = 'block';
                            urlInput.required = false;
                            fileInput.required = true;
                        } else {
                            urlGroup.style.display = 'block';
                            fileGroup.style.display = 'none';
                            urlInput.required = true;
                            fileInput.required = false;
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('upload-form');
                        
                        form.addEventListener('submit', function(e) {
                            const type = document.getElementById('material_type').value;
                            
                            // Only use AJAX for file uploads to show progress
                            if (type === 'pdf') {
                                e.preventDefault();
                                
                                const formData = new FormData(form);
                                const progressBar = document.getElementById('progress-bar');
                                const progressPercent = document.getElementById('progress-percent');
                                const progressContainer = document.getElementById('progress-container');
                                const submitBtn = document.getElementById('submit-btn');

                                progressContainer.style.display = 'block';
                                submitBtn.disabled = true;
                                submitBtn.innerText = 'Uploading...';

                                window.axios.post(form.action, formData, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    },
                                    onUploadProgress: function(progressEvent) {
                                        const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                                        progressBar.style.width = percentCompleted + '%';
                                        progressPercent.innerText = percentCompleted + '%';
                                    }
                                })
                                .then(function (response) {
                                    if(window.showToast) window.showToast('File uploaded successfully!', 'success');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                })
                                .catch(function (error) {
                                    submitBtn.disabled = false;
                                    submitBtn.innerText = 'Add Material';
                                    progressContainer.style.display = 'none';
                                    
                                    let msg = 'Upload failed. Please check file size and try again.';
                                    if (error.response && error.response.data && error.response.data.message) {
                                        msg = error.response.data.message;
                                    }
                                    if(window.showToast) window.showToast(msg, 'error');
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection

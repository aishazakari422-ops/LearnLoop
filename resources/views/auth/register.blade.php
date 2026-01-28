@extends('layouts.app')

@section('title', 'Register - LearnLoop')

@section('content')
<div style="max-width: 500px; margin: 4rem auto;">
    <div class="card">
        <div class="card-header" style="justify-content: center; flex-direction: column;">
            <h2 style="margin-bottom: 0.5rem; text-align: center;">Join LearnLoop</h2>
            <p style="text-align: center;">Start your organized learning journey today</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">I am a...</label>
                <select name="role" id="role" class="form-control">
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Create Account</button>
            </div>

            <div style="text-align: center; margin-top: 1rem;">
                <p style="font-size: 0.9rem;">Already have an account? <a href="{{ route('login') }}" style="color: var(--primary);">Log in</a></p>
            </div>
        </form>
    </div>
</div>
@endsection

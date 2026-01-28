@extends('layouts.app')

@section('title', 'Login - LearnLoop')

@section('content')
<div style="max-width: 400px; margin: 4rem auto;">
    <div class="card">
        <div class="card-header" style="justify-content: center; flex-direction: column;">
            <h2 style="margin-bottom: 0.5rem; text-align: center;">Welcome Back</h2>
            <p style="text-align: center;">Login to continue learning</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Log In</button>
            </div>

            <div style="text-align: center; margin-top: 1rem;">
                <p style="font-size: 0.9rem;">Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary);">Register</a></p>
            </div>
        </form>
    </div>
</div>
@endsection

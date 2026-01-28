<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LearnLoop')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Dashboard specific overrides */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        main {
            flex: 1;
            padding: 2rem 0;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .sidebar {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.05);
            height: fit-content;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }

        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .sidebar-link svg {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" class="logo">LearnLoop</a>
                
                <div class="nav-links">
                    <a href="{{ url('/') }}" class="nav-item">Home</a>
                    @guest
                        <a href="{{ url('/#features') }}" class="nav-item">Features</a>
                        <a href="{{ url('/#about') }}" class="nav-item">About</a>
                    @endguest
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a>
                        <a href="{{ route('courses.index') }}" class="nav-item">Courses</a>
                        <a href="{{ route('profile.edit') }}" class="nav-item">Profile</a>
                        <span style="color: var(--text-muted); margin-left: 1rem;">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Logout</button>
                        </form>
                    @else
                        <div style="margin-left: 1rem; display: flex; gap: 1rem;">
                            <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        </div>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <main style="padding-top: 100px;">
        <div class="container">
            <div class="toast-container" id="toast-container"></div>

            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3 class="logo" style="margin-bottom: 1rem;">LearnLoop</h3>
                    <p>Structured self-learning for NSUK students. Track progress, organize resources, and achieve your goals.</p>
                </div>
                
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/#features') }}">Features</a></li>
                        <li><a href="{{ url('/#about') }}">About Us</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Support</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Connect</h4>
                    <div class="social-icons">
                        <a href="#" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                        <a href="#" aria-label="GitHub">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} LearnLoop. Built for NSUK Students.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for session messages - logic moved to app.js but we call it here with Blade data
            @if(session('success'))
                if(window.showToast) showToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                if(window.showToast) showToast("{{ session('error') }}", 'error');
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    if(window.showToast) showToast("{{ $error }}", 'error');
                @endforeach
            @endif
        });
    </script>
</body>
</html>

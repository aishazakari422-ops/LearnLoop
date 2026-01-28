<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LearnLoop - Stay Consistent. Learn Better.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ url('/') }}" class="logo">LearnLoop</a>
                
                <div class="nav-links">
                    <a href="#features">Features</a>
                    <a href="#about">About</a>
                    
                    @if (Route::has('login'))
                        <div class="auth-buttons">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-bg"></div>
            <div class="container hero-content">
                <h1>Stay Consistent. Learn Better.</h1>
                <p>Structure your self-learning, track your progress, and achieve your skill development goals with NSUK's premier learning management system.</p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 2rem;">Get Started Today</a>
                    <a href="#how-it-works" class="btn btn-outline" style="margin-left: 1rem; font-size: 1.2rem; padding: 1rem 2rem;">Learn More</a>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" style="padding: 80px 0; background: rgba(30, 41, 59, 0.3);">
            <div class="container">
                <div class="section-header">
                    <h2>How It Works</h2>
                    <p>Get started with LearnLoop in 3 simple steps.</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card" style="text-align: center;">
                        <div style="font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.1); margin-bottom: 1rem;">01</div>
                        <h3 style="margin-bottom: 1rem;">Create Account</h3>
                        <p>Sign up as a student to access your personal dashboard. It's free and takes less than a minute.</p>
                    </div>

                    <div class="feature-card" style="text-align: center;">
                        <div style="font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.1); margin-bottom: 1rem;">02</div>
                        <h3 style="margin-bottom: 1rem;">Set Goals</h3>
                        <p>Define what you want to learn. Set start and target dates to keep yourself accountable.</p>
                    </div>

                    <div class="feature-card" style="text-align: center;">
                        <div style="font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.1); margin-bottom: 1rem;">03</div>
                        <h3 style="margin-bottom: 1rem;">Track Progress</h3>
                        <p>Add study materials to your goals and update your progress bar as you complete them.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features">
            <div class="container">
                <div class="section-header">
                    <h2>Everything you need to succeed</h2>
                    <p>Powerful tools designed to keep you on track.</p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                        </div>
                        <h3>Set Clear Goals</h3>
                        <p>Define your learning path with specific start and target dates. Break down big skills into manageable milestones.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        </div>
                        <h3>Organize Materials</h3>
                        <p>Keep all your PDFs, video links, and tutorial resources in one place, linked directly to your goals.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                        </div>
                        <h3>Track Progress</h3>
                        <p>Visual progress bars help you see how far you've come and motivate you to cross the finish line.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About/Problem Section -->
        <section id="about" class="about">
            <div class="container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>Why LearnLoop?</h2>
                        <p style="margin-bottom: 1.5rem;">
                            Many students at Nasarawa State University, Keffi (NSUK) struggle with organizing self-learning alongside academic studies. Scattered resources and lack of structure lead to abandoned goals.
                        </p>
                        <p>
                            <strong>LearnLoop is the solution.</strong> We provide a structured environment where you can organize materials, set deadlines, and visually track your growth. Whether you're learning Web Development, Graphic Design, or any other skill, LearnLoop keeps you accountable.
                        </p>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Free for Students</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Access Anywhere</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} LearnLoop. Built for NSUK Students.</p>
        </div>
    </footer>
</body>
</html>

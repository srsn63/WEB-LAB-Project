<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Resources | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #60a5fa !important;
        }
        
        .page-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 4rem 0;
            margin-bottom: 3rem;
            text-align: center;
            color: white;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .section-title {
            color: #60a5fa;
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid #3b82f6;
        }
        
        .resource-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
            border-color: rgba(96, 165, 250, 0.4);
        }
        
        .resource-card h5 {
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        
        .resource-card p {
            color: #cbd5e1;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        .resource-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        
        .resource-badge {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .resource-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .resource-link:hover {
            color: #93c5fd;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #94a3b8;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .btn-back {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: rgba(59, 130, 246, 0.3);
            color: #bfdbfe;
            border-color: rgba(59, 130, 246, 0.5);
        }
        
        .resource-nav {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .nav-link-btn {
            background: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
            border: 2px solid rgba(59, 130, 246, 0.3);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-link-btn:hover,
        .nav-link-btn.active {
            background: rgba(59, 130, 246, 0.3);
            color: #bfdbfe;
            border-color: rgba(96, 165, 250, 0.6);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .nav-link-btn i {
            font-size: 1.1rem;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        section {
            scroll-margin-top: 2rem;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: rgba(59, 130, 246, 0.9);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .back-to-top:hover {
            background: rgba(96, 165, 250, 0.9);
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
        }
        
        .back-to-top.show {
            display: flex;
        }
    </style>
</head>
<body>
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up" style="font-size: 1.5rem;"></i>
    </a>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                KUET CSE
            </a>
            <div class="ms-auto">
                <a href="{{ route('home') }}#students" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1>Academic Resources</h1>
            <p>Find course materials, syllabi, and academic calendars for your program</p>
            
            <!-- Navigation Menu -->
            <div class="resource-nav mt-4">
                <a href="#course-materials" class="nav-link-btn active">
                    <i class="bi bi-folder-fill"></i> Course Materials
                </a>
                <a href="#syllabus" class="nav-link-btn">
                    <i class="bi bi-book-fill"></i> Syllabus
                </a>
                <a href="#academic-calendars" class="nav-link-btn">
                    <i class="bi bi-calendar-event-fill"></i> Academic Calendars
                </a>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Course Materials Section -->
        <section id="course-materials" class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-folder-fill me-2"></i>Course Materials
            </h2>
            @forelse($courseMaterials as $material)
                <div class="resource-card">
                    <h5>{{ $material->title }}</h5>
                    @if($material->description)
                        <p>{{ $material->description }}</p>
                    @endif
                    <div class="resource-meta">
                        @if($material->course_code)
                            <span class="resource-badge">
                                <i class="bi bi-code-square"></i> {{ $material->course_code }}
                            </span>
                        @endif
                        @if($material->semester)
                            <span class="resource-badge">
                                <i class="bi bi-calendar3"></i> {{ $material->semester }}
                            </span>
                        @endif
                    </div>
                    <div class="d-flex gap-3">
                        @if($material->file_url)
                            <a href="{{ $material->file_url }}" target="_blank" class="resource-link">
                                <i class="bi bi-file-earmark-pdf"></i> Download Material
                            </a>
                        @endif
                        @if($material->external_link)
                            <a href="{{ $material->external_link }}" target="_blank" class="resource-link">
                                <i class="bi bi-link-45deg"></i> External Link
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-folder-x"></i>
                    <p>No course materials available at the moment.</p>
                </div>
            @endforelse
        </section>

        <!-- Syllabus Section -->
        <section id="syllabus" class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-book-fill me-2"></i>Syllabus
            </h2>
            @forelse($syllabi as $syllabus)
                <div class="resource-card">
                    <h5>{{ $syllabus->title }}</h5>
                    @if($syllabus->description)
                        <p>{{ $syllabus->description }}</p>
                    @endif
                    <div class="resource-meta">
                        @if($syllabus->course_code)
                            <span class="resource-badge">
                                <i class="bi bi-code-square"></i> {{ $syllabus->course_code }}
                            </span>
                        @endif
                        @if($syllabus->semester)
                            <span class="resource-badge">
                                <i class="bi bi-calendar3"></i> {{ $syllabus->semester }}
                            </span>
                        @endif
                    </div>
                    <div class="d-flex gap-3">
                        @if($syllabus->file_url)
                            <a href="{{ $syllabus->file_url }}" target="_blank" class="resource-link">
                                <i class="bi bi-file-earmark-pdf"></i> Download Syllabus
                            </a>
                        @endif
                        @if($syllabus->external_link)
                            <a href="{{ $syllabus->external_link }}" target="_blank" class="resource-link">
                                <i class="bi bi-link-45deg"></i> External Link
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-book-x"></i>
                    <p>No syllabi available at the moment.</p>
                </div>
            @endforelse
        </section>

        <!-- Academic Calendars Section -->
        <section id="academic-calendars" class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-calendar-event-fill me-2"></i>Academic Calendars
            </h2>
            @forelse($academicCalendars as $calendar)
                <div class="resource-card">
                    <h5>{{ $calendar->title }}</h5>
                    @if($calendar->description)
                        <p>{{ $calendar->description }}</p>
                    @endif
                    <div class="resource-meta">
                        @if($calendar->semester)
                            <span class="resource-badge">
                                <i class="bi bi-calendar3"></i> {{ $calendar->semester }}
                            </span>
                        @endif
                    </div>
                    <div class="d-flex gap-3">
                        @if($calendar->file_url)
                            <a href="{{ $calendar->file_url }}" target="_blank" class="resource-link">
                                <i class="bi bi-file-earmark-pdf"></i> Download Calendar
                            </a>
                        @endif
                        @if($calendar->external_link)
                            <a href="{{ $calendar->external_link }}" target="_blank" class="resource-link">
                                <i class="bi bi-link-45deg"></i> External Link
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <p>No academic calendars available at the moment.</p>
                </div>
            @endforelse
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to top button functionality
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Active navigation link based on scroll position
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link-btn');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>

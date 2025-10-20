<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - {{ $program->short_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
        }

        .navbar h4 {
            margin: 0;
            font-weight: 700;
        }

        .btn-nav {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-left: 0.5rem;
        }

        .btn-nav:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }

        .program-info-card {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .program-info-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .program-info-card .info-items {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .program-info-card .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .program-info-card .info-item i {
            color: #60a5fa;
        }

        .add-course-section {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .add-course-section h5 {
            color: #60a5fa;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label {
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 0.75rem;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #60a5fa;
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select option {
            background: #1e293b;
            color: #ffffff;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 1.25rem;
            height: 1.25rem;
        }

        .form-check-input:checked {
            background-color: #60a5fa;
            border-color: #60a5fa;
        }

        .form-check-label {
            color: #94a3b8;
            margin-left: 0.5rem;
        }

        .btn-add {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .semester-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 1rem;
        }

        .semester-tab {
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .semester-tab:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #60a5fa;
        }

        .semester-tab.active {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            border-color: transparent;
        }

        .courses-section {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .courses-section h5 {
            color: #60a5fa;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .course-table {
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .course-table thead th {
            background: rgba(96, 165, 250, 0.2);
            color: #60a5fa;
            padding: 1rem;
            font-weight: 700;
            border: none;
            text-align: left;
        }

        .course-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: middle;
        }

        .course-table tbody tr:last-child td {
            border-bottom: none;
        }

        .course-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .badge-type {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-mandatory {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .badge-elective {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-remove {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-remove:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            color: white;
        }

        .credit-summary-box {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .credit-summary-box h6 {
            color: #60a5fa;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .credit-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .credit-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .credit-item .year-label {
            font-size: 0.9rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .credit-item .credit-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #60a5fa;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .alert {
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        @media (max-width: 768px) {
            .semester-tabs {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .course-table {
                font-size: 0.9rem;
            }

            .course-table thead th,
            .course-table tbody td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-book"></i> Manage Program Courses</h4>
            <div>
                <a href="{{ route('admin.programs.index') }}" class="btn-nav">
                    <i class="fas fa-arrow-left"></i> Back to Programs
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Program Info Card -->
        <div class="program-info-card">
            <h3>{{ $program->name }}</h3>
            <div class="info-items">
                <div class="info-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span><strong>{{ $program->short_name }}</strong></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $program->duration }}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-award"></i>
                    <span><strong>{{ $program->total_credits }}</strong> Total Credits</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-tag"></i>
                    <span>{{ ucfirst($program->degree_type) }}</span>
                </div>
            </div>
        </div>

        <!-- Add Course Section -->
        <div class="add-course-section">
            <h5><i class="fas fa-plus-circle"></i> Add Course to Program</h5>
            <form action="{{ route('admin.programs.add-course', $program) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="course_id" class="form-label">Select Course</label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value="">Choose a course...</option>
                            @foreach($availableCourses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->course_code }} - {{ $course->course_name }} ({{ $course->credits }} credits)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="year" class="form-label">Year</label>
                        <select name="year" id="year" class="form-select" required>
                            <option value="">Year</option>
                            <option value="1">Year 1</option>
                            <option value="2">Year 2</option>
                            <option value="3">Year 3</option>
                            <option value="4">Year 4</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="semester" class="form-label">Semester</label>
                        <select name="semester" id="semester" class="form-select" required>
                            <option value="">Sem</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label d-block">Type</label>
                        <div class="form-check" style="margin-top: 0.5rem;">
                            <input class="form-check-input" type="checkbox" name="is_mandatory" id="is_mandatory" value="1" checked>
                            <label class="form-check-label" for="is_mandatory">
                                Mandatory
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-add w-100">
                            <i class="fas fa-plus"></i> Add Course
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Semester Filter Tabs -->
        <div class="semester-tabs">
            @foreach($semesters as $semKey => $semLabel)
                <a href="{{ route('admin.programs.courses', ['program' => $program, 'filter' => $semKey]) }}" 
                   class="semester-tab {{ $selectedSemester === $semKey ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $semLabel }}
                </a>
            @endforeach
        </div>

        <!-- Assigned Courses Section -->
        <div class="courses-section">
            <h5>
                <i class="fas fa-list"></i> 
                @if($selectedSemester === 'all')
                    All Assigned Courses
                @else
                    Courses - {{ $semesters[$selectedSemester] }}
                @endif
            </h5>

            @if($selectedSemester === 'all')
                <!-- Display all courses grouped by year and semester -->
                @php
                    $hasAnyCourses = false;
                    foreach($coursesByYearSemester as $yearCourses) {
                        foreach($yearCourses as $semesterCourses) {
                            if(count($semesterCourses) > 0) {
                                $hasAnyCourses = true;
                                break 2;
                            }
                        }
                    }
                @endphp

                @if($hasAnyCourses)
                    @for($year = 1; $year <= 4; $year++)
                        @php
                            $yearHasCourses = false;
                            foreach([1, 2] as $sem) {
                                if(isset($coursesByYearSemester[$year][$sem]) && count($coursesByYearSemester[$year][$sem]) > 0) {
                                    $yearHasCourses = true;
                                    break;
                                }
                            }
                        @endphp
                        
                        @if($yearHasCourses)
                            <h6 style="color: #60a5fa; font-weight: 700; margin: 2rem 0 1rem 0; padding-bottom: 0.5rem; border-bottom: 2px solid rgba(96, 165, 250, 0.3);">
                                <i class="fas fa-graduation-cap"></i> Year {{ $year }}
                            </h6>
                            
                            @foreach([1, 2] as $semester)
                                @if(isset($coursesByYearSemester[$year][$semester]) && count($coursesByYearSemester[$year][$semester]) > 0)
                                    <div style="margin-bottom: 2rem;">
                                        <div style="color: #94a3b8; font-weight: 600; margin-bottom: 1rem; padding-left: 1rem; border-left: 3px solid #60a5fa;">
                                            <i class="fas fa-calendar-alt"></i> Semester {{ $semester }}
                                        </div>
                                        <table class="course-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%;">Code</th>
                                                    <th style="width: 40%;">Course Name</th>
                                                    <th style="width: 10%;">Credits</th>
                                                    <th style="width: 15%;">Type</th>
                                                    <th style="width: 20%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($coursesByYearSemester[$year][$semester] as $programCourse)
                                                    <tr>
                                                        <td><strong>{{ $programCourse->course->course_code }}</strong></td>
                                                        <td>{{ $programCourse->course->course_name }}</td>
                                                        <td>{{ $programCourse->course->credits }}</td>
                                                        <td>
                                                            @if($programCourse->is_mandatory)
                                                                <span class="badge-type badge-mandatory">Mandatory</span>
                                                            @else
                                                                <span class="badge-type badge-elective">Elective</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('admin.programs.remove-course', [$program, $programCourse]) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-remove" onclick="return confirm('Remove this course from the program?')">
                                                                    <i class="fas fa-trash"></i> Remove
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endfor
                @else
                    <div class="empty-state">
                        <i class="fas fa-book-open"></i>
                        <h5>No Courses Assigned Yet</h5>
                        <p>Start building the curriculum by adding courses to this program.</p>
                    </div>
                @endif
            @else
                <!-- Display filtered semester courses -->
                @php
                    list($filterYear, $filterSemester) = explode('-', $selectedSemester);
                    $filteredCourses = $coursesByYearSemester[$filterYear][$filterSemester] ?? [];
                @endphp

                @if(count($filteredCourses) > 0)
                    <table class="course-table">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Code</th>
                                <th style="width: 40%;">Course Name</th>
                                <th style="width: 10%;">Credits</th>
                                <th style="width: 15%;">Type</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filteredCourses as $programCourse)
                                <tr>
                                    <td><strong>{{ $programCourse->course->course_code }}</strong></td>
                                    <td>{{ $programCourse->course->course_name }}</td>
                                    <td>{{ $programCourse->course->credits }}</td>
                                    <td>
                                        @if($programCourse->is_mandatory)
                                            <span class="badge-type badge-mandatory">Mandatory</span>
                                        @else
                                            <span class="badge-type badge-elective">Elective</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.programs.remove-course', [$program, $programCourse]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove" onclick="return confirm('Remove this course from the program?')">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Courses for {{ $semesters[$selectedSemester] }}</h5>
                        <p>Add courses using the form above.</p>
                    </div>
                @endif
            @endif
        </div>

        <!-- Credit Summary -->
        <div class="credit-summary-box">
            <h6><i class="fas fa-calculator"></i> Credit Summary by Year</h6>
            <div class="credit-items">
                @for($year = 1; $year <= 4; $year++)
                    @php
                        $yearCredits = 0;
                        foreach([1, 2] as $sem) {
                            if(isset($coursesByYearSemester[$year][$sem])) {
                                foreach($coursesByYearSemester[$year][$sem] as $pc) {
                                    $yearCredits += $pc->course->credits;
                                }
                            }
                        }
                    @endphp
                    <div class="credit-item">
                        <div class="year-label">Year {{ $year }}</div>
                        <div class="credit-value">{{ $yearCredits }}</div>
                        <small style="color: #94a3b8;">credits</small>
                    </div>
                @endfor
            </div>
            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.2); text-align: center;">
                <strong style="color: #60a5fa; font-size: 1.1rem;">
                    Total Assigned Credits: {{ array_sum(array_map(function($year) use ($coursesByYearSemester) {
                        $sum = 0;
                        foreach([1, 2] as $sem) {
                            if(isset($coursesByYearSemester[$year][$sem])) {
                                foreach($coursesByYearSemester[$year][$sem] as $pc) {
                                    $sum += $pc->course->credits;
                                }
                            }
                        }
                        return $sum;
                    }, range(1, 4))) }} / {{ $program->total_credits }}
                </strong>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

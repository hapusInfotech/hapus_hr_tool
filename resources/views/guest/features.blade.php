@extends('layouts.guest.guest')

@section('title', 'Features')
@section('head')

    <link rel="stylesheet" href="{{ asset('assets/css/guest/features.css') }}">

@endsection

@section('content')
    <!-- Banner Section -->
    <section class="features-banner text-center text-dark">
        <div class="container">
            <h1>Our Features</h1>
            <p class="lead">Discover the tools and features that make Hapus HR Tool the best solution for managing your
                workforce.</p>
        </div>
    </section>

    <!-- Feature Section 1: Employee Management -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Employee Management</h2>
            <p class="text-center">Manage all your employee records in one place, track attendance, and handle employee
                leaves efficiently.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Centralized Employee Records</h4>
                        <p>Maintain detailed records of each employee, including personal information, employment history,
                            and more.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Attendance Tracking</h4>
                        <p>Keep track of employee attendance and generate reports to monitor productivity and working hours.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section 2: Payroll Management -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="section-title text-center">Payroll Management</h2>
            <p class="text-center">Automate payroll calculations and make sure your employees are paid accurately and on
                time.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Automated Payroll Calculations</h4>
                        <p>Automatically calculate salaries based on attendance and deductions, and generate payroll reports
                            easily.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Customizable Salary Structures</h4>
                        <p>Create salary structures that fit your company’s needs, including allowances, bonuses, and other
                            adjustments.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section 3: Performance Management -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Performance Management</h2>
            <p class="text-center">Monitor employee performance with feedback tools and performance reviews.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Goal Setting & Tracking</h4>
                        <p>Set goals for employees and track their progress over time to ensure targets are met.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Feedback & Reviews</h4>
                        <p>Conduct regular performance reviews and gather feedback from employees to drive continuous
                            improvement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section 4: Reports and Analytics -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="section-title text-center">Reports and Analytics</h2>
            <p class="text-center">Get detailed reports and insights into your HR operations with our powerful analytics
                tools.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>Detailed Reporting</h4>
                        <p>Generate reports on employee attendance, payroll, performance, and more with just a few clicks.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h4>HR Analytics</h4>
                        <p>Use analytics tools to make data-driven decisions about your workforce and improve HR efficiency.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section 5: Compliance Management -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Compliance Management</h2>
            <p class="text-center">Ensure that your HR processes comply with local labor laws and regulations.</p>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="feature-box">
                        <h4>Regulatory Compliance</h4>
                        <p>Stay compliant with labor laws by automating compliance tracking and reporting.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

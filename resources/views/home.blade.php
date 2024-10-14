@extends('layouts.common.commonUserDashboard')

@section('content')

    <div class="container">
        <div class="row about-tool-row bg-white">
            <div class="col-md-6">
                <div class="tool-dexc">
                    <h1 class="fw-bold">Hapus HR Tool</h1>
                    <p class="fs-5">Our HR tool streamlines employee management, attendance tracking, payroll
                        processing, and performance reviews.</p>
                    <ul>
                        <li class="fs-5"><span class="fw-bold">Employee Management:</span> Manage roles and track
                            employee records.</li>
                        <li class="fs-5"><span class="fw-bold">Attendance Tracking: </span>Track attendance and
                            leave schedules.</li>
                        <li class="fs-5"><span class="fw-bold">Payroll Processing: </span>Calculate payroll based on
                            attendance.</li>
                        <li class="fs-5"><span class="fw-bold">Performance Reviews: </span>Monitor employee
                            performance.</li>
                        <li class="fs-5"><span class="fw-bold">Analytics and Reporting:</span> Generate insights for
                            decision-making.</li>
                    </ul>
                    <div class="custom-btn mt-5">
                        <a class=" text-decoration-none arrow_right fw-bold button-90" href="">Read more </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tool-img">
                    {{-- <img src="" alt="HR Tool Dashboard" class="w-100"> --}}
                </div>
            </div>
        </div>


        <div class="row pricing-details-row bg-white">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Choose the Perfect Plan for Your Business</h2>
                <p class="fs-5">We offer flexible plans to fit your business needs, from our free trial for smaller teams to our affordable basic plan for growing businesses. Each plan provides access to essential HR tools that make managing your team easier than ever.</p>
            </div>
            <div class="col-md-6">
                <div class="pricing-wrapper second-section z-1 position-relative">
                    <div class="last-card"></div>
                    <div class="first-card">
                        <div class="card-content text-center">
                            <p class="m-0">TRIAL PLAN</p>
                            <h1 class="">Free</h1>
                            <p class="">Up to 10 Users</p>
                        </div>
                        <div class="card-list d-flex justify-content-center">
                            <ul>
                                <li class="fw-bold mb-2 fs-5">Access to <span class="fw-normal">core HR management features</span></li>
                                <li class="fw-bold mb-2 fs-5">Manage <span class="fw-normal">up to 10 employees</span></li>
                                <li class="fw-bold mb-2 fs-5">Track <span class="fw-normal">attendance and leaves</span></li>
                                <li class="fw-bold mb-2 fs-5">Basic <span class="fw-normal">payroll management</span></li>
                                <li class="fw-bold mb-2 fs-5">Generate <span class="fw-normal">simple reports</span></li>
                                <li class="fw-bold mb-2 fs-5">Limited <span class="fw-normal">support</span></li>
                            </ul>
                        </div>
                        <div class="price-button d-flex justify-content-center">
                            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}" class="btn btn-lg btn-primary">Start Free Trial</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="pricing-wrapper second-section second z-1 position-relative">
                    <div class="last-card"></div>
                    <div class="first-card">
                        <div class="card-content text-center">
                            <p class="m-0">BASIC PLAN</p>
                            <h1 class="">$10.99/month</h1>
                            <p class="">25 Users included</p>
                        </div>
                        <div class="card-list d-flex justify-content-center">
                            <ul>
                                <li class="fw-bold mb-2 fs-5">Manage <span class="fw-normal">up to 25 employees</span></li>
                                <li class="fw-bold mb-2 fs-5">Advanced <span class="fw-normal">HR management features</span></li>
                                <li class="fw-bold mb-2 fs-5">Attendance <span class="fw-normal">tracking and reporting</span></li>
                                <li class="fw-bold mb-2 fs-5">Payroll <span class="fw-normal">processing</span></li>
                                <li class="fw-bold mb-2 fs-5">Email <span class="fw-normal">export for reports</span></li>
                                <li class="fw-bold mb-2 fs-5">Generate <span class="fw-normal">detailed performance reviews</span></li>
                            </ul>
                        </div>
                        <div class="price-button d-flex justify-content-center">
                            <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}" class="btn btn-lg btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    <div class="container-fluid">
        <!--   <h4 class="page-title">Dashboard</h4> -->

        <!-- Pricing Section -->
        <i class="background"></i>
        <!-- Combined Subscription Plans Section -->
        <!-- Combined Subscription Plans Section -->
        <section class="subscription-plans-section">
            <div class="container-fluid">


                <!-- Bootstrap Notify Alerts -->
                @if (Session::has('success'))
                    <script type="text/javascript">
                        $.notify({
                            message: "{{ Session::get('success') }}"
                        }, {
                            type: 'success',
                            delay: 5000,
                            placement: {
                                from: "top",
                                align: "right"
                            },
                        });
                    </script>
                @endif

                @if (Session::has('error'))
                    <script type="text/javascript">
                        $.notify({
                            message: "{{ Session::get('error') }}"
                        }, {
                            type: 'danger',
                            delay: 5000,
                            placement: {
                                from: "top",
                                align: "right"
                            },
                        });
                    </script>
                @endif

                @if (Session::has('warning'))
                    <script type="text/javascript">
                        $.notify({
                            message: "{{ Session::get('warning') }}"
                        }, {
                            type: 'warning',
                            delay: 5000,
                            placement: {
                                from: "top",
                                align: "right"
                            },
                        });
                    </script>
                @endif

                {{-- <div class="container">

                    <!-- Plan Details Section -->
                    <div class="row mt-5">

                        <!-- Trial Plan Details -->
                        <div class="col-sm-4">
                            <div class="plan-details trial-details p-4 shadow-sm rounded">
                                <h3 class="text-center mb-4">Trial Subscription Plan</h3>
                                <p class="text-muted text-center">
                                    The <strong>Trial</strong> plan allows you to explore our HR tool for <strong>14
                                        days</strong> at no cost.
                                    This plan includes up to <strong>10 users</strong> and provides access to key features
                                    to get you started.
                                </p>
                                <ul>
                                    <li><strong>10 Users:</strong> Perfect for small teams looking to test the platform.
                                    </li>
                                    <li><strong>1 GB RAM:</strong> Suitable for handling basic tasks and initial setup.</li>
                                    <li><strong>20 GB Storage:</strong> Store essential files and data during the trial
                                        period.</li>
                                    <li><strong>5 Email Accounts:</strong> Set up key email accounts for communication.</li>
                                    <li><strong>Basic Support:</strong> Access to limited support for minor issues.</li>
                                </ul>
                                <p class="text-muted text-center">
                                    Experience all the essential features without commitment. Upgrade to a paid plan to
                                    continue using the platform after the trial.
                                </p>
                                <div class="text-center">
                                    <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}"
                                        class="btn btn-lg btn-success">Start Free Trial</a>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Plan Details -->
                        <div class="col-sm-4">
                            <div class="plan-details basic-details p-4 shadow-sm rounded">
                                <h3 class="text-center mb-4">Basic Subscription Plan</h3>
                                <p class="text-muted text-center">
                                    The <strong>Basic</strong> plan is designed for small to medium-sized teams. For just
                                    <strong>$9.99/month</strong>, you can manage up to <strong>30 users</strong>
                                    and access all the essential features needed to streamline HR operations.
                                </p>
                                <ul>
                                    <li><strong>30 Users:</strong> Ideal for small to medium teams with growth potential.
                                    </li>
                                    <li><strong>2 GB RAM:</strong> More power for handling complex tasks and operations.
                                    </li>
                                    <li><strong>40 GB Storage:</strong> Store essential files, documents, and team data
                                        securely.</li>
                                    <li><strong>10 Email Accounts:</strong> Manage communication with up to 10 dedicated
                                        email addresses.</li>
                                    <li><strong>Standard Support:</strong> Access to essential support for operational
                                        efficiency.</li>
                                </ul>
                                <p class="text-muted text-center">
                                    This plan is perfect for businesses looking for a cost-effective way to manage their HR
                                    needs without sacrificing key features.
                                </p>
                                <div class="text-center">
                                    <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 30]) }}"
                                        class="btn btn-lg btn-primary">Get Started with Basic</a>
                                </div>
                            </div>
                        </div>

                        <!-- Extended Basic Plan Details -->
                        <div class="col-sm-4">
                            <div class="plan-details extended-basic-details p-4 shadow-sm rounded">
                                <h3 class="text-center mb-4">Extended Basic Plan</h3>
                                <p class="text-muted text-center">
                                    The <strong>Extended Basic</strong> plan is ideal for large teams with more than
                                    <strong>30 users</strong>. For just <strong>$25.99/month</strong>,
                                    you'll have access to advanced features and tools to manage a growing workforce
                                    effectively.
                                </p>
                                <ul>
                                    <li><strong>Unlimited Users:</strong> Perfect for managing larger teams and
                                        organizations.</li>
                                    <li><strong>4 GB RAM:</strong> Power to handle advanced tasks and performance tracking.
                                    </li>
                                    <li><strong>100 GB Storage:</strong> Securely store a large volume of documents, files,
                                        and data.</li>
                                    <li><strong>25 Email Accounts:</strong> Manage communication with a large team using
                                        multiple email accounts.</li>
                                    <li><strong>Premium Support:</strong> Access to priority support for complex operations
                                        and troubleshooting.</li>
                                </ul>
                                <p class="text-muted text-center">
                                    Designed for larger organizations, this plan provides everything you need to manage a
                                    bigger workforce and ensure smooth HR operations.
                                </p>
                                <div class="text-center">
                                    <a href="{{ route('subscription.basic', ['plan' => 'extended', 'no_of_ppl' => 50]) }}"
                                        class="btn btn-lg btn-primary">Get Started with Extended Basic</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
    </div>




    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

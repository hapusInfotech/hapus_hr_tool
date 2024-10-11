@extends('layouts.common.commonUserDashboard')

@section('content')
<div class="pricing-plans">

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="pricing-wrapper second-section z-1 position-relative">
                    <div class="last-card"></div>
                    <div class="first-card">
                        <div class="card-content text-center">
                            <p class="m-0">TRAIL</p>
                            <h1 class="">Free</h1>
                            <p class="">10 Users included</p>
                        </div>
                        <div class="card-list d-flex justify-content-center">
                            <ul>
                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                        videos</span>
                                </li>
                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                        ePub</span></li>
                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                        Tests</span></li>
                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                        tutorials</span></li>

                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                        illustrations</span>
                                </li>

                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                        use</span></li>

                            </ul>
                        </div>
                        <div class="price-button d-flex justify-content-center">
                            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}" class="btn btn-lg btn-primary">Get Started</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-wrapper second-section second z-1 position-relative">
                    <div class="last-card"></div>
                    <div class="first-card">
                        <div class="card-content text-center">
                            <p class="m-0">BASIC</p>
                            <h1 class="">$9.99/month</h1>
                            <p class="">30 Users included</p>
                        </div>
                        <div class="card-list d-flex justify-content-center">
                            <ul>
                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                        videos</span>
                                </li>
                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                        ePub</span></li>
                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                        Tests</span></li>
                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                        tutorials</span></li>

                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                        illustrations</span>
                                </li>

                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                        use</span></li>

                            </ul>
                        </div>
                        <div class="price-button d-flex justify-content-center">
                            <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}" class="btn btn-lg btn-primary">Get Started</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="pricing-wrapper second-section third z-1 position-relative">
                    <div class="last-card"></div>
                    <div class="first-card">
                        <div class="card-content text-center">
                            <p class="m-0">TRAIL</p>
                            <h1 class="">Free</h1>
                            <p class="">10 members included</p>
                        </div>
                        <div class="card-list d-flex justify-content-center">
                            <ul>
                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                        videos</span>
                                </li>
                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                        ePub</span></li>
                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                        Tests</span></li>
                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                        tutorials</span></li>

                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                        illustrations</span>
                                </li>

                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                        use</span></li>

                            </ul>
                        </div>
                        <div class="price-button d-flex justify-content-center">
                            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}" class="btn btn-lg btn-primary">Get Started</a>
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
                    type: 'success'
                    , delay: 5000
                    , placement: {
                        from: "top"
                        , align: "right"
                    }
                , });

            </script>
            @endif

            @if (Session::has('error'))
            <script type="text/javascript">
                $.notify({
                    message: "{{ Session::get('error') }}"
                }, {
                    type: 'danger'
                    , delay: 5000
                    , placement: {
                        from: "top"
                        , align: "right"
                    }
                , });

            </script>
            @endif

            @if (Session::has('warning'))
            <script type="text/javascript">
                $.notify({
                    message: "{{ Session::get('warning') }}"
                }, {
                    type: 'warning'
                    , delay: 5000
                    , placement: {
                        from: "top"
                        , align: "right"
                    }
                , });

            </script>
            @endif

            <div class="container">


                <!-- Plan Details Section -->
                <div class="row mt-5">
                    <!-- Trial Plan Details -->
                    <div class="col-sm-6">
                        <div class="plan-details trial-details p-4 shadow-sm rounded">
                            <h3 class="text-center mb-4">Trial Subscription Plan Details</h3>
                            <p class="text-muted text-center">
                                The <strong>Trial</strong> plan is a risk-free opportunity to test our
                                HR tool for <strong>14 days</strong>. You can register up to <strong>10
                                    users</strong> and access essential features that are perfect for
                                getting started and exploring the platform.
                            </p>
                            <ul>
                                <li><strong>10 Users:</strong> Suitable for small teams or groups
                                    testing the system.</li>
                                <li><strong>1 GB RAM:</strong> Provides enough power to handle light
                                    applications and basic operations.</li>
                                <li><strong>20 GB Storage:</strong> Ideal for storing initial data,
                                    files, and projects while exploring the system.</li>
                                <li><strong>5 Email Accounts:</strong> Set up a few key email accounts
                                    for communication and management during the trial period.</li>
                                <li><strong>Limited Support:</strong> During the trial, access to basic
                                    support for resolving minor issues or queries.</li>
                            </ul>
                            <p class="text-muted text-center">
                                This plan is perfect for small teams who want to experience our HR
                                platform's core functionalities without any financial commitment. After
                                the trial, you can upgrade to a paid plan for full access.
                            </p>
                            <div class="text-center">
                                <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}" class="btn btn-lg btn-success">Start Free Trial</a>
                            </div>
                        </div>
                    </div>

                    <!-- Basic Plan Details -->
                    <div class="col-sm-6">
                        <div class="plan-details basic-details p-4 shadow-sm rounded">
                            <h3 class="text-center mb-4">Basic Subscription Plan Details</h3>
                            <p class="text-muted text-center">
                                The <strong>Basic</strong> plan is designed for small to medium-sized
                                teams. For just <strong>$9.99/month</strong>, you get access to all the
                                essential features needed to manage your team effectively, with support
                                for up to <strong>30 users</strong>.
                            </p>
                            <ul>
                                <li><strong>30 Users:</strong> Ideal for small to medium teams, with
                                    sufficient capacity for managing multiple employees or team members.
                                </li>
                                <li><strong>2 GB RAM:</strong> Power to handle more complex applications
                                    and tasks, perfect for growing teams.</li>
                                <li><strong>40 GB Storage:</strong> Store important files, documents,
                                    and data securely with adequate storage space.</li>
                                <li><strong>10 Email Accounts:</strong> Manage email communication more
                                    effectively with up to 10 email addresses.</li>
                                <li><strong>Limited Support:</strong> Gain access to essential support,
                                    ensuring smooth operations and troubleshooting.</li>
                            </ul>
                            <p class="text-muted text-center">
                                This plan is perfect for businesses looking for a cost-effective
                                solution to manage their teams, data, and internal communications
                                without compromising on key functionalities.
                            </p>
                            <div class="text-center">
                                <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}" class="btn btn-lg btn-primary">Get Started with Basic</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

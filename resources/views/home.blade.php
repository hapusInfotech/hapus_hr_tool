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
            <a href="{{ route('trail.landing') }}">
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
            </a>
        </div>

        <div class="col-md-6">

            <a href="{{ route('basic.landing') }}" class="text-decoration-none">


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
            </a>
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



        </div>
</div>




</section>
@endsection



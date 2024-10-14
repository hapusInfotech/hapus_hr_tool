@extends('layouts.common.commonUserDashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/paymentmsg.css') }}">

</head>

<body>

    <div class="bg-fail">

        <div class="card">

            <span class="card__failure"><img src="{{ asset('assets/img/delete.png') }}" alt="Failure"></span>

            <h1 class="card__msg">Payment Failed</h1>
            <h2 class="card__submsg">We're sorry, but your payment could not be processed. Please try again.</h2>

            <div class="card__body">

                <div class="profile-section d-flex justify-content-center">
                    <div class="profile-img">
                        <img src="{{ asset('assets/img/profile.jpg') }}" class="card__avatar">
                    </div>

                    <div class="card__recipient-info">
                        <p class="card__recipient">Nath Green</p>
                        <p class="card__email">hello@nathgreen.co.uk</p>
                    </div>
                </div>

                <h1 class="card__price"><span>£</span>20<span>.00</span></h1>

                <p class="card__method">Payment method</p>
                <div class="card__payment">
                    <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png"
                        class="card__credit-card" alt="Visa logo">
                    <div class="card__card-details">
                        <p class="card__card-type">Credit / debit card</p>
                        <p class="card__card-number">Visa ending in **89</p>
                    </div>
                </div>

            </div>

            <div class="card__tags">
                <span class="card__tag">Failed</span>
                <span class="card__tag">#123456789</span>
            </div>

        </div>

    </div>

@endsection
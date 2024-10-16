@extends('layouts.common.commonUserDashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/paymentmsg.css') }}">


<div class="bg">

    <div class="card">

        <span class="card__success">
            <img src="{{ asset('assets/img/check.png') }}" alt="Success">
        </span>

        {{-- {{ dd($payment_data) }} --}}
        <h1 class="card__msg">Payment Complete</h1>
        <h2 class="card__submsg">Thank you for your transfer. Your transaction has been successfully completed.</h2>

        <div class="card__body">

            <div class="profile-section d-flex justify-content-center">
                <div class="profile-img">
                    <img src="{{ asset('assets/img/profile.jpg') }}" class="card__avatar">
                </div>

                <div class="card__recipient-info">
                    {{-- <p class="card__recipient">Nath Green</p> --}}
                    <p class="card__email">{{ $payment_data['email'] }}</p>
                </div>
            </div>

            <h1 class="card__price"><span>{{ $payment_data['symbol'] }}</span>{{ $payment_data['amount']/100
                }}<span>.00</span></h1>

            <p class="card__method">Payment method</p>
            @if($payment_data['card'] != null)


            <div class="card__payment">

                <div class="card__card-details">
                    <p class="card__card-type">Credit / debit card</p>
                    <h5 class="card__card-number ">{{ $payment_data['card']['network'] }} ending in {{
                        $payment_data['card']['last4'] }}</h5>
                </div>
            </div>
            @endif
            <div class="card text-white bg-outline-success mb-3">

                <div class="card-body">
                    <h5 class="card-title">Transaction Success !!</h5>
                    <p class="card-text">Transaction Id :{{ $payment_data['payment_id'] }}
                        <span>Funds is not Refundble</span>
                    </p>
                </div>
            </div>
            <a href="{{ route('company.company_create',['sid' =>$payment_data['sid'] ]) }}"> Create Company</a>
        </div>

        <div class="card__tags">
            <span class="card__tag">Completed</span>
            <span class="card__tag">#123456789</span>
        </div>

    </div>

</div>
@endsection
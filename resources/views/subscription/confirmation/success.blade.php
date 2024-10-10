<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <!-- Google Fonts for Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/paymentmsg.css') }}">


</head>

<body>

    <div class="bg">

        <div class="card">

            <span class="card__success">
                <img src="{{ asset('assets/img/check.png') }}" alt="Success">
            </span>
            

            <h1 class="card__msg">Payment Complete</h1>
            <h2 class="card__submsg">Thank you for your transfer. Your transaction has been successfully completed.</h2>

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
                <span class="card__tag">Completed</span>
                <span class="card__tag">#123456789</span>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

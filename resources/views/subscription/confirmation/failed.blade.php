<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>

    <!-- Google Fonts for Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .bg {
            background-color: #ff4c4c; /* Red background for failure */
            width: 480px;
            overflow: hidden;
            margin: 0 auto;
            box-sizing: border-box;
            padding: 40px;
            font-family: 'Roboto', sans-serif;
            margin-top: 40px;
        }

        .card {
            background-color: #fff;
            width: 100%;
            margin-top: 40px;
            border-radius: 5px;
            box-sizing: border-box;
            padding: 80px 30px 25px 30px;
            text-align: center;
            position: relative;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .card__failure {
            position: absolute;
            top: -50px;
            left: 133px;
            width: 118px;
            height: 118px;
            border-radius: 100%;
            background-color: #fff;
            border: 5px solid #fff;
        }

        .card__failure img {
            width: 110px;
        }

        .card__msg {
            text-transform: uppercase;
            color: #000;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .card__submsg {
            color: #555555;
            font-size: 16px;
            font-weight: 400;
            margin-top: 0px;
        }

        .card__body {
            background-color: #f8f6f6;
            border-radius: 4px;
            width: 100%;
            margin-top: 30px;
            padding: 30px;
        }

        .card__avatar {
            width: 50px;
            height: 50px;
            border-radius: 100%;
            display: inline-block;
            margin-right: 10px;
            position: relative;
            top: 7px;
        }

        .card__recipient-info {
            display: inline-block;
        }

        .card__recipient {
            color: #000;
            text-align: left;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .card__email {
            color: #555555;
            text-align: left;
            margin-top: 0px;
        }

        .card__price {
            color: #000;
            font-size: 70px;
            margin-top: 25px;
            margin-bottom: 30px;
        }

        .card__price span {
            font-size: 60%;
        }

        .card__method {
            color: #555555;
            text-transform: uppercase;
            text-align: left;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .card__payment {
            background-color: #fff;
            border-radius: 4px;
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card__credit-card {
            width: 50px;
            display: inline-block;
            margin-right: 15px;
        }

        .card__card-details {
            display: inline-block;
            text-align: left;
        }

        .card__card-type {
            text-transform: uppercase;
            color: #000;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .card__card-number {
            color: #555555;
            font-size: 12px;
            margin-top: 0px;
        }

        .card__tags {
            padding-top: 15px;
        }

        .card__tag {
            text-transform: uppercase;
            background-color: #f8f6f6;
            padding: 3px 5px;
            border-radius: 3px;
            font-size: 10px;
            color: #555555;
        }
    </style>

</head>

<body>

    <div class="bg">

        <div class="card">

            <span class="card__failure"><img src="./img/delete.png" alt="Failure"></span>

            <h1 class="card__msg">Payment Failed</h1>
            <h2 class="card__submsg">We're sorry, but your payment could not be processed. Please try again.</h2>

            <div class="card__body">

                <div class="profile-section d-flex justify-content-center">
                    <div class="profile-img">
                        <img src="{{ asset('img/user (1).png') }}" class="card__avatar">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

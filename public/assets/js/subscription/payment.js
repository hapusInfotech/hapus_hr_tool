$(document).ready(function () {
    $("#cancel-pay").on('click', function (y) {
        y.preventDefault();
        if (isLoggedIn) {
            location.href = "/home";
        } else {
            location.href = "/";
        }
    });

    $('#payBtn').on('click', function (e) {
        e.preventDefault();

        // Fetch the Razorpay Key via AJAX
        $.ajax({
            url: '/get-razorpay-key',
            type: 'GET',
            success: function (response) {
                var razorpayKey = response.razorpay_key;
                var amount = $('#amount').val(); // Fetch the amount
                var order_id = $('#order_id').val(); // Fetch the unique order ID
                var user_id = $('#user_id').val(); // Fetch the user ID
                var current_plan = $('#plan').val(); // Plan type (basic/trial)

                // Convert amount to paise (e.g., ₹1900 = 190000 paise)
                var amountInPaise = amount ;

                // Razorpay options setup
                var options = {
                    "key": razorpayKey,
                    "amount": amountInPaise,  // Amount in paise
                    "name": $('#company_name').val(),
                    "description": "Subscription Payment",
                    "image": "https://www.hapusinfotech.com/sites/default/files/hapus_logo_1.png",
                    "prefill": {
                        "name": $('#name').val(),
                        "email": $('#email').val(),
                        "contact": $('#phone').val()
                    },
                    "theme": {
                        "color": "#F37254"
                    },
                    handler: function (response) {
                        $('#paymentForm').append('<input type="hidden" name="razorpay_payment_id" value="' + response.razorpay_payment_id + '">');
                        $('#paymentForm').append('<input type="hidden" name="razorpay_subscription_id" value="' + response.razorpay_subscription_id + '">');
                        $('#paymentForm').append('<input type="hidden" name="razorpay_signature" value="' + response.razorpay_signature + '">');
                        $('#paymentForm').append('<input type="hidden" name="order_id" value="' + order_id + '">');
                        $('#paymentForm').append('<input type="hidden" name="user_id" value="' + user_id + '">');
                        $('#paymentForm').submit();
                    }
                };

                // Set method restrictions based on plan type
                if (current_plan === 'basic') {
                    options.method = {
                        "card": true,
                        "netbanking": true,
                        "paylater": true,
                        "upi": true,  // Enable UPI
                        "wallet": false  // Disable wallets (PhonePe, etc.)
                    };
                } else if (current_plan === 'trial') {
                    options.method = {
                        "card": true,
                        "netbanking": true,
                        "paylater": true,
                        "wallet": true,   // Enable wallets for trial
                        "upi": true       // Enable UPI for trial
                    };
                }

                console.log(options.method); // Debug to verify methods
                console.log(current_plan);

                // Open Razorpay payment gateway
                var rzp1 = new Razorpay(options);
                rzp1.open();
            },
            error: function (xhr, status, error) {
                console.log('Error fetching Razorpay Key: ', error);
            }
        });
    });
});

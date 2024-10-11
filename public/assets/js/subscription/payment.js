$(document).ready(function () {
    // Function to handle Razorpay payments
    function handleRazorpayPayment(planType) {
        // Fetch the Razorpay Key via AJAX
        $.ajax({
            url: '/get-razorpay-key', // Route to return Razorpay key
            type: 'GET',
            success: function (response) {
                var razorpayKey = response.razorpay_key; // Fetched Razorpay key
                var amount = $('#amount').val() ;
                var current_plan = planType || $('#plan').val(); // Plan type (basic/trial)

                // Basic configuration common for both plans
                var options = {
                    "key": razorpayKey,
                    "amount": amount,
                    "currency": $('#currency').val(),
                    "name": $('#company_name').val(),
                    "description": current_plan === 'trial' ? "Trial Subscription Payment" : "Basic Payment",
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
                        // Append Razorpay payment details to the form
                        $('#paymentForm').append('<input type="hidden" name="razorpay_payment_id" value="' + response.razorpay_payment_id + '">');
                        $('#paymentForm').append('<input type="hidden" name="razorpay_signature" value="' + response.razorpay_signature + '">');

                        // Additional fields for trial subscription
                        if (current_plan === 'trial') {
                            $('#paymentForm').append('<input type="hidden" name="razorpay_subscription_id" value="' + response.razorpay_subscription_id + '">');
                        } else {
                            $('#paymentForm').append('<input type="hidden" name="razorpay_order_id" value="' + response.razorpay_order_id + '">');
                        }

                        $('#paymentForm').submit(); // Submit the form
                    }
                };

                // Different options for basic vs trial plan
                if (current_plan === 'basic') {
                    options.method = {
                        "card": true,
                        "netbanking": true,
                        "paylater": true,
                        "upi": true,
                        "wallet": false  // Disable wallets for basic
                    };
                } else if (current_plan === 'trial') {
                    // For trial plans, the subscription ID is mandatory
                    options.subscription_id = $('#subscription_id').val();
                }

                // Initialize Razorpay and open the payment window
                var rzp1 = new Razorpay(options);
                rzp1.open();
            },
            error: function (xhr, status, error) {
                console.log('Error fetching Razorpay Key: ', error);
            }
        });
    }

    // Handling the "Pay" button click for both trial and basic plans
    $('#payBtn').on('click', function (e) {
        e.preventDefault();
        var current_plan = $('#plan').val(); // Check the plan type

        if (current_plan === 'trial') {
            // Call the Razorpay function for trial plan
            handleRazorpayPayment('trial');
        } else if (current_plan === 'basic') {
            // Call the Razorpay function for basic plan
            handleRazorpayPayment('basic');
        }
    });

    // Optional: Cancel payment redirection logic for the "Cancel" button
    $("#cancel-pay").on('click', function (e) {
        e.preventDefault();
        if (isLoggedIn) {
            location.href = "/home";
        } else {
            location.href = "/";
        }
    });
});

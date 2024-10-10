$(document).ready(function () {
    $("#subscription-form-basic").parsley();
    // Store the fixed cost per head value
    var fixedCostPerHead = 100;

    // Set the initial fixed value for cost per head
    $('#cost_per_head').val(fixedCostPerHead);
    var isTrial = $("#plan").val();
    console.log(isTrial);

    if (isTrial == 'trial') {
        var noOfPeople = $("#no_of_people").val();
        if (noOfPeople == 10) {
            var totalCost = noOfPeople * fixedCostPerHead;
            $('#cost_per_head').val(totalCost);
        }

        // Update the cost per head field with the total cost

    } else {

        $('#no_of_people').on('input', function (e) {
            e.preventDefault();

            var noOfPeople = $(this).val();

            // Check if the value is empty or zero
            if (noOfPeople == '' || noOfPeople == 0) {
                $('#cost_per_head').val(fixedCostPerHead); // Reset to fixed cost per head
            } else {
                var totalCost = noOfPeople * fixedCostPerHead; // Calculate the total cost

                // Update the cost per head field with the total cost
                $('#cost_per_head').val(totalCost); // Display the total cost in the same field
            }

        });
    }
});

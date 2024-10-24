$(document).ready(function () {
    $("#subscription-form-basic").parsley();

    var fixedCostPerHead = $('#get-basic-amt').val();
    var fixedCostPerHeadTrail = ($('#get-trail-amt').val()) ?? 100;
    var isTrial = $("#plan").val();


    if (isTrial == 'trial') {
        var noOfPeople = $("#no_of_people").val();
        if (noOfPeople == 10) {
            var totalCost = noOfPeople * fixedCostPerHeadTrail;
            $('#cost_per_head').val(totalCost);
        }

    } else {

        $('#no_of_people').on('input', function () {
            var noOfPeople = $(this).val();

            // Default to 25 people if no value or 0 is entered
            if (noOfPeople === '' || noOfPeople == 0) {
                noOfPeople = 1;
            }

            // Calculate the total cost based on the number of people
            var totalCost = noOfPeople * fixedCostPerHead;
            $('#cost_per_head').val(totalCost);
        });


    }
});

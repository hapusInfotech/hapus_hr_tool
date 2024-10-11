$(document).ready(function () {
    $("#subscription-form-basic").parsley();

    var fixedCostPerHead = 100;

    var isTrial = $("#plan").val();


    if (isTrial == 'trial') {
        var noOfPeople = $("#no_of_people").val();
        if (noOfPeople == 10) {
            var totalCost = noOfPeople * fixedCostPerHead;
            $('#cost_per_head').val(totalCost);
        }

    } else {

        var noOfPeople = $('#no_of_people').val();

        if (noOfPeople == '' || noOfPeople == 0) {
            var noOfPeopl = 25;
            var adjustCost = noOfPeopl * fixedCostPerHead;
            $('#cost_per_head').val(adjustCost);
        } else {
            var totalCost = noOfPeople * fixedCostPerHead;
            $('#cost_per_head').val(totalCost);
        }


    }
});

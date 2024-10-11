$(document).ready(function () {
    $('#amount').on('input', function (e) {
        e.preventDefault();
        var val = $(this).val();
        if (val != '') {
            var newval = val * 100;
            $("#amount_in_paisa").val(newval);
        } else {
            var newval = 0;

            $("#amount_in_paisa").val(newval);

        }
    })
});
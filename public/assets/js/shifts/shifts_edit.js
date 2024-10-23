$(document).ready(function () {
    $("#shift_type").change(function () {
        var shiftType = $(this).val();
        var liberalHrsContainer = $("#liberal_hrs_container");
        var liberalHrsInput = $("#shift_liberal_hrs");

        if (shiftType === "Liberal") {
            liberalHrsContainer.show();
            liberalHrsInput.prop("required", true);
        } else {
            liberalHrsContainer.hide();
            liberalHrsInput.prop("required", false);
        }
    });
});

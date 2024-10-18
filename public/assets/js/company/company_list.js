$(document).ready(function () {
    // Handle the delete button click to open the modal with the correct company data
    $("#deleteModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var companyId = button.data("company-id"); // Extract company ID from data-* attributes
        var companyName = button.data("company-name"); // Extract company name from data-* attributes

        // Update the modal content
        var modal = $(this);
        modal
            .find(".modal-body")
            .text("Are you sure you want to delete " + companyName + "?");

        // Update the form action URL with the correct company ID
        $("#deleteForm").attr("action", "/company/" + companyId);
    });
    // Get CSRF token from meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    // Listen for the change event on the toggle
    $(".company-status-toggle").change(function () {
        var companyId = $(this).data("company-id");
        var newStatus = $(this).prop("checked") ? 1 : 0; // 1 for active, 0 for inactive
        // Find the associated span element for this checkbox
        var statusSpan = $(this).siblings(".company-status");

        // Send an AJAX request to update the company status
        $.ajax({
            url: "/company/update-status/" + companyId, // Your update status route
            type: "POST",
            data: {
                _token: csrfToken, // CSRF token for Laravel
                company_status: newStatus,
            },
            success: function (response) {
                // Update the span based on the new status
                if (newStatus === 1) {
                    statusSpan.text("Active");
                } else {
                    statusSpan.text("Inactive");
                }
                // Optional: Show a success message or handle UI updates
                alert("Company status updated successfully.");
            },
            error: function (xhr) {
                // Handle error if the request fails
                alert("Error updating company status. Please try again.");
            },
        });
    });
});
{
    /* <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> */
}

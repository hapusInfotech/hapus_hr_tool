$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    // Handle status toggle
    $('.status-toggle').on('change', function () {
        var employeeId = $(this).data('employee-id');
        var status = $(this).is(':checked') ? 1 : 0;
        var spinner = $('#spinner-' + employeeId);
        var statusText = $('#status-text-' + employeeId);

        // Show the spinner while updating the status
        spinner.removeClass('d-none');

        // AJAX request to update the status
        $.ajax({
            url: '/employees/update-status', // The route to update status
            type: 'POST',
            data: {
                emp_id: employeeId,
                status: status
            },
            success: function (response) {
                // Hide spinner and show success alert
                spinner.addClass('d-none');
                $('#statusUpdateAlert').removeClass('d-none');

                // Update the status text dynamically
                if (status == 1) {
                    statusText.text('Active');
                } else {
                    statusText.text('Inactive');
                }

                // Hide alert after 3 seconds
                setTimeout(function () {
                    $('#statusUpdateAlert').addClass('d-none');
                }, 5000);
            },
            error: function (error) {
                console.error('Failed to update status:', error);
                spinner.addClass('d-none');
            }
        });
    });
});

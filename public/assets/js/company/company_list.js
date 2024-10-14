$(document).ready(function () {
    // Handle showing the delete modal with dynamic content
    var deleteModal = document.getElementById("deleteModal");

    deleteModal.addEventListener("show.bs.modal", function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;

        // Extract data from the button attributes
        var companyId = button.getAttribute("data-company-id");
        var companyName = button.getAttribute("data-company-name");

        // Select elements in the modal to update content
        var deleteMessage = deleteModal.querySelector("#deleteMessage");
        var deleteForm = deleteModal.querySelector("#deleteForm");

        // Set the form action to the correct route
        deleteForm.action = "/company/" + companyId;

        // Update the delete message
        deleteMessage.textContent = 'Are you sure you want to delete the company "' + companyName + '"?';
    });
});
{/* <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> */}

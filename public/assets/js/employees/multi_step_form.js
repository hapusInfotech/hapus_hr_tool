$(document).ready(function () {
    // Hide all steps except the active one
    $(".form-step").each(function () {
        if (!$(this).hasClass("active")) {
            $(this).hide();
        }
    });

    // Handle next button click for each step
    $(".next-step").on("click", function () {
        var currentStep = $(this).closest(".form-step");

        if (currentStep.attr("id") === "step-1") {
            // Validate Employee Details (Step 1)
            validateStep1().then(function (isValid) {
                if (isValid) {
                    moveToNextStep(currentStep);
                } else {
                    console.log(
                        "Validation failed for Employee Details. Please fix the errors."
                    );
                }
            });
        } else if (currentStep.attr("id") === "step-2") {
            // Validate Work Details (Step 2)
            validateWorkDetails().then(function (isValid) {
                if (isValid) {
                    moveToNextStep(currentStep);
                } else {
                    console.log(
                        "Validation failed for Work Details. Please fix the errors."
                    );
                }
            });
        } else if (currentStep.attr("id") === "step-3") {
            // Validate Reporting To (Step 3)
            validateReportingTo().then(function (isValid) {
                if (isValid) {
                    moveToNextStep(currentStep);
                } else {
                    console.log(
                        "Validation failed for Reporting To. Please fix the errors."
                    );
                }
            });
        }
    });

    // Handle previous button click
    $(".prev-step").on("click", function () {
        var currentStep = $(this).closest(".form-step");
        moveToPreviousStep(currentStep);
    });

    // Move to the next step
    function moveToNextStep(currentStep) {
        currentStep.hide();
        currentStep.removeClass("active");
        currentStep.next(".form-step").show().addClass("active");
    }

    // Move to the previous step
    function moveToPreviousStep(currentStep) {
        currentStep.hide();
        currentStep.removeClass("active");
        currentStep.prev(".form-step").show().addClass("active");
    }

    // Fetch departments when the page loads
    function loadDepartments() {
        $.ajax({
            url: "/employees/departments",
            method: "GET",
            success: function (response) {
                $("#department_id")
                    .empty()
                    .append('<option value="">Select Department</option>');
                if (response.length === 0) {
                    $("#department_id").append(
                        '<option value="">Please add the department</option>'
                    );
                } else {
                    $.each(response, function (index, department) {
                        $("#department_id").append(
                            '<option value="' +
                                department.id +
                                '">' +
                                department.department +
                                "</option>"
                        );
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch departments:", error);
            },
        });
    }

    // Initial load of departments
    loadDepartments();

    // Fetch roles when a department is selected
    $("#department_id").on("change", function () {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                url: "/employees/roles/" + departmentId,
                method: "GET",
                success: function (response) {
                    $("#emp_role")
                        .empty()
                        .append('<option value="">Select Role</option>');
                    if (response.length === 0) {
                        $("#emp_role").append(
                            '<option value="">Please add the roles</option>'
                        );
                    } else {
                        $.each(response, function (index, role) {
                            $("#emp_role").append(
                                '<option value="' +
                                    role.id +
                                    '">' +
                                    role.roles +
                                    "</option>"
                            );
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Failed to fetch roles:", error);
                },
            });
        } else {
            $("#emp_role")
                .empty()
                .append('<option value="">Please add the roles</option>');
        }
    });

    // When the "Same as Present Address" checkbox is clicked
    $("#same_as_present").on("change", function () {
        if ($(this).is(":checked")) {
            $("#permanent_address")
                .val($("#present_address").val())
                .prop("readonly", true);
            $("#present_address").on("input", function () {
                if ($("#same_as_present").is(":checked")) {
                    $("#permanent_address").val($(this).val());
                }
            });
        } else {
            $("#present_address").off("input");
            $("#permanent_address").prop("readonly", false).val("");
        }
    });

    // Initialize Select2 for Reporting To field
    $("#reporting_to_id").select2({
        placeholder: "Select Employee",
        ajax: {
            url: "/employees/search",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    query: params.term || "",
                    all: params.term ? "true" : "",
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(function (employee) {
                        return {
                            id: employee.emp_id,
                            text:
                                employee.emp_name +
                                " (" +
                                employee.emp_id +
                                ")",
                        };
                    }),
                };
            },
            cache: true,
        },
        minimumInputLength: 0,
        language: {
            noResults: function () {
                return "No results found";
            },
        },
        escapeMarkup: function (markup) {
            return markup;
        },
    });

    // Validate emp_id as the user types
    $("#emp_id").on("input", function () {
        var empId = $(this).val();
        if (empId) {
            checkFieldAvailability(
                "emp_id",
                empId,
                "#emp_id_status",
                "Employee ID"
            );
        } else {
            $("#emp_id_status").text("").removeClass("is-valid is-invalid");
        }
    });

    // Validate emp_username as the user types
    $("#emp_username").on("input", function () {
        var empUsername = $(this).val();
        if (empUsername) {
            checkFieldAvailability(
                "emp_username",
                empUsername,
                "#emp_username_status",
                "Employee username"
            );
        } else {
            $("#emp_username_status")
                .text("")
                .removeClass("is-valid is-invalid");
        }
    });

    // Validate emp_email as the user types
    $("#emp_email").on("input", function () {
        var empEmail = $(this).val();
        if (empEmail) {
            checkFieldAvailability(
                "emp_email",
                empEmail,
                "#emp_email_status",
                "Employee email"
            );
        } else {
            $("#emp_email_status").text("").removeClass("is-valid is-invalid");
        }
    });

    // Function to check field availability via AJAX
    function checkFieldAvailability(
        fieldName,
        fieldValue,
        statusElement,
        fieldLabel
    ) {
        $.ajax({
            url: "/employees/check-availability",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                field: fieldName,
                value: fieldValue,
            },
            success: function (response) {
                if (response.isAvailable) {
                    $(statusElement)
                        .text(`${fieldLabel} is available`)
                        .css("color", "green")
                        .addClass("is-valid")
                        .removeClass("is-invalid");
                } else {
                    $(statusElement)
                        .text(`${fieldLabel} is not available`)
                        .css("color", "red")
                        .addClass("is-invalid")
                        .removeClass("is-valid");
                }
            },
            error: function () {
                $(statusElement)
                    .text("Error checking availability")
                    .addClass("is-invalid")
                    .removeClass("is-valid");
            },
        });
    }

    // Function to validate fields in step 1 (Employee Details)
    function validateStep1() {
        let isValid = true;
        let requiredFields = [
            "#emp_name",
            "#emp_id",
            "#emp_username",
            "#emp_email",
            "#department_id",
            "#emp_role",
        ];

        // Check if required fields are filled
        requiredFields.forEach(function (field) {
            if ($(field).val().trim() === "") {
                $(field).addClass("is-invalid");
                isValid = false;
            } else {
                $(field).removeClass("is-invalid");
            }
        });

        // Return a promise after checking field availability (only if fields are filled)
        let promises = [];
        if ($("#emp_id").val().trim() !== "") {
            promises.push(
                checkFieldAvailability(
                    "emp_id",
                    $("#emp_id").val(),
                    "#emp_id_status",
                    "Employee ID"
                )
            );
        }
        if ($("#emp_username").val().trim() !== "") {
            promises.push(
                checkFieldAvailability(
                    "emp_username",
                    $("#emp_username").val(),
                    "#emp_username_status",
                    "Employee username"
                )
            );
        }
        if ($("#emp_email").val().trim() !== "") {
            promises.push(
                checkFieldAvailability(
                    "emp_email",
                    $("#emp_email").val(),
                    "#emp_email_status",
                    "Employee email"
                )
            );
        }

        return $.when.apply($, promises).then(function () {
            let allAvailable = true;
            if ($("#emp_id_status").text().includes("not available")) {
                allAvailable = false;
            }
            if ($("#emp_username_status").text().includes("not available")) {
                allAvailable = false;
            }
            if ($("#emp_email_status").text().includes("not available")) {
                allAvailable = false;
            }
            return isValid && allAvailable;
        });
    }

    // Function to validate fields in step 2 (Work Details)
    function validateWorkDetails() {
        let isValid = true;
        let requiredFields = [
            "#shift_id", // Shift
            "#location", // Location
            "#designation", // Designation
            "#date_of_joining", // Date of Joining
        ];

        // Check if required fields are filled
        requiredFields.forEach(function (field) {
            if ($(field).val().trim() === "") {
                $(field).addClass("is-invalid");
                isValid = false;
            } else {
                $(field).removeClass("is-invalid");
            }
        });

        return $.Deferred().resolve(isValid).promise(); // Return promise for consistency
    }

    // Validate Reporting To field
    function validateReportingTo() {
        let isValid = true;
        let reportingToId = $("#reporting_to_id").val(); // Get the value using Select2 API

        if (reportingToId === "" || reportingToId === null) {
            // Apply validation error styles
            $("#reporting_to_id")
                .next(".select2")
                .find(".select2-selection")
                .addClass("is-invalid");
            isValid = false;
        } else {
            // Remove validation error styles
            $("#reporting_to_id")
                .next(".select2")
                .find(".select2-selection")
                .removeClass("is-invalid");
        }

        return $.Deferred().resolve(isValid).promise(); // Return promise for consistency
    }
});

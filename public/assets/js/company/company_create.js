// public/js/phoneMask.js

$(document).ready(function () {
    console.log("test");
    // Mask for vendor phone number input
    $("#company_phone_number").mask("000000000000");

    // Function to populate country dropdown
    function populateCountries() {
        $.ajax({
            url: "http://api.geonames.org/countryInfoJSON",
            method: "GET",
            data: {
                username: "hapusinfotech",
            },
            success: function (data) {
                if (data.geonames.length > 0) {
                    var countryDropdown = $("#country");
                    data.geonames.forEach(function (country) {
                        // Add country options to the select element
                        countryDropdown.append(
                            `<option value="${country.geonameId}">${country.countryName}</option>`
                        );
                    });
                }
            },
            error: function () {
                alert("Error fetching countries.");
            },
        });
    }

    // Populate countries on page load
    populateCountries();

    // Function to populate states based on the selected country
    $("#country").on("change", function () {
        var geonameId = $(this).val();
        var countryName = $("#country option:selected").text(); // Get the selected country name
        $("#country_name").val(countryName); // Set hidden input with country name

        if (geonameId) {
            $.ajax({
                url: `http://api.geonames.org/childrenJSON`,
                method: "GET",
                data: {
                    geonameId: geonameId,
                    username: "hapusinfotech",
                },
                success: function (data) {
                    var stateDropdown = $("#state");
                    stateDropdown.empty(); // Clear existing state options
                    stateDropdown.append(
                        '<option value="">Select State</option>'
                    ); // Add default option

                    if (data.geonames.length > 0) {
                        data.geonames.forEach(function (state) {
                            stateDropdown.append(
                                `<option value="${state.geonameId}">${state.name}</option>`
                            );
                        });
                    } else {
                        stateDropdown.append(
                            '<option value="">No states available</option>'
                        );
                    }
                },
                error: function () {
                    alert("Error fetching states.");
                },
            });
        } else {
            $("#state")
                .empty()
                .append('<option value="">Select State</option>');
        }
    });

    // When state is selected, fetch the state name
    $("#state").on("change", function () {
        var stateName = $("#state option:selected").text(); // Get the selected state name
        $("#state_name").val(stateName); // Set hidden input with state name
    });

    $("#company_prefix").on("input", function () {
        var inputVal = $(this).val();
        var lowerCaseVal = inputVal.toLowerCase();

        // Check if the input contains capital letters
        if (inputVal !== lowerCaseVal) {
            $(".company-prefix-error").text("Please enter only small letters.");
            $("#company_prefix").addClass("is-invalid");
        } else {
            $(".company-prefix-error").text(""); // Clear the message if input is valid
            $("#company_prefix").removeClass("is-invalid");
        }

        // Convert the input to lowercase and only allow lowercase letters
        // $(this).val(lowerCaseVal.replace(/[^a-z]/g, "")); // Allow only lowercase letters
        var companyPrefix = $(this).val();

        if (companyPrefix.length > 0) {
            $.ajax({
                url: "/check-company-prefix", // Corrected URL without parameter
                method: "POST",
                data: {
                    company_prefix: companyPrefix,
                    _token: $('meta[name="csrf-token"]').attr("content"), // Use the CSRF token
                },
                success: function (response) {
                    if (response.exists) {
                        $("#company_prefix").addClass("is-invalid");
                        $(".company-prefix-error").text(
                            "Company prefix is already taken."
                        );
                    } else {
                        $("#company_prefix").removeClass("is-invalid");
                        $(".company-prefix-error").text("");
                    }
                },
            });
        } else {
            $("#company_prefix").removeClass("is-invalid");
            $(".company-prefix-error").text("");
        }
    });

    $("#company_email").on("change", function () {

        var companyEmail = $(this).val();

        if (companyEmail.length > 0) {
            $.ajax({
                url: "/check-company-email", // Corrected URL without parameter
                method: "POST",
                data: {
                    company_email: companyEmail,
                    _token: $('meta[name="csrf-token"]').attr("content"), // Use the CSRF token
                },
                success: function (response) {
                    if (response.exists) {
                        $("#company_email").addClass("is-invalid");
                        $(".company-email-error").text(
                            "Company email is already taken."
                        );
                    } else {
                        $("#company_email").removeClass("is-invalid");
                        $(".company-email-error").text("");
                    }
                },
            });
        } else {
            $("#company_email").removeClass("is-invalid");
            $(".company-email-error").text("");
        }
    });
});

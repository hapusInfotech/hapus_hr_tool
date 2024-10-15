$(document).ready(function() {

    // Mask for vendor phone number input
    $("#phone_number").mask("000000000000");

    // Fetch and populate country dropdown
    $.ajax({
        url: 'http://api.geonames.org/countryInfoJSON',
        method: 'GET',
        data: {
            username: 'hapusinfotech'
        },
        success: function(response) {
            var countries = response.geonames;
            $.each(countries, function(index, country) {
                $('#country').append(`<option value="${country.geonameId}" data-country-name="${country.countryName}">${country.countryName}</option>`);
            });
        },
        error: function(error) {
            console.log("Error fetching countries:", error);
        }
    });

    // Set country name in hidden input when a country is selected
    $('#country').on('change', function() {
        var geonameId = $(this).val();
        var countryName = $('#country option:selected').data('country-name');
        $('#country_name').val(countryName); // Set the country name in the hidden field

        // Fetch states when a country is selected
        if (geonameId) {
            $.ajax({
                url: `http://api.geonames.org/childrenJSON`,
                method: 'GET',
                data: {
                    geonameId: geonameId,
                    username: 'hapusinfotech'
                },
                success: function(response) {
                    $('#state').empty().append('<option value="">Select a state</option>'); // Clear previous options
                    var states = response.geonames;
                    if (states.length > 0) {
                        $.each(states, function(index, state) {
                            $('#state').append(`<option value="${state.geonameId}" data-state-name="${state.name}">${state.name}</option>`);
                        });
                    } else {
                        $('#state').append('<option value="">No states available</option>');
                    }
                },
                error: function(error) {
                    console.log("Error fetching states:", error);
                }
            });
        } else {
            $('#state').empty().append('<option value="">Select a state</option>'); // Reset state dropdown
        }
    });

    // Set state name in hidden input when a state is selected
    $('#state').on('change', function() {
        var stateName = $('#state option:selected').data('state-name');
        $('#state_name').val(stateName); // Set the state name in the hidden field
    });


});

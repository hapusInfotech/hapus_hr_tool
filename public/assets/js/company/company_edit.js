$(document).ready(function () {
    // Get the country and state values from the hidden fields
    var selectedCountry = $('#selectedCountry').val(); // The geonameId of the country
    var selectedState = $('#selectedState').val(); // The geonameId of the state

    // Load countries when the page loads
    loadCountries(selectedCountry);

    // Load states when a country is selected
    $('#country').change(function () {
        var countryId = $(this).val();
        var countryName = $("#country option:selected").text(); // Get the selected country name
        $('#country_name').val(countryName); // Set hidden input with country name
        if (countryId) {
            loadStates(countryId, null); // Pass null for states to load fresh
        } else {
            $('#state').html('<option value="">Select State</option>'); // Reset states dropdown
        }
    });

    // Function to load countries
    function loadCountries(selectedCountryId) {
        $.ajax({
            url: "http://api.geonames.org/countryInfoJSON?username=hapusinfotech",
            type: "GET",
            dataType: "json",
            success: function (response) {
                var countries = response.geonames;
                var countryOptions = '<option value="">Select Country</option>';

                $.each(countries, function (index, country) {
                    countryOptions += `<option value="${country.geonameId}" ${country.geonameId == selectedCountryId ? 'selected' : ''}>${country.countryName}</option>`;
                });

                $('#country').html(countryOptions);

                // If there's a selected country, load the states for that country
                if (selectedCountryId) {
                    loadStates(selectedCountryId, selectedState); // Pass selectedState to preselect
                }
            },
            error: function () {
                alert('Error fetching countries');
            }
        });
    }

    // Function to load states based on selected country
    function loadStates(countryId, selectedStateId) {
        $.ajax({
            url: `http://api.geonames.org/childrenJSON?geonameId=${countryId}&username=hapusinfotech`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                var states = response.geonames;
                var stateOptions = '<option value="">Select State</option>';

                $.each(states, function (index, state) {
                    stateOptions += `<option value="${state.geonameId}" ${state.geonameId == selectedStateId ? 'selected' : ''}>${state.name}</option>`;
                });

                $('#state').html(stateOptions);
            },
            error: function () {
                alert('Error fetching states');
            }
        });
    }
    // When state is selected, fetch the state name
    $('#state').on('change', function () {
        var stateName = $("#state option:selected").text(); // Get the selected state name
        $('#state_name').val(stateName); // Set hidden input with state name
    });
});

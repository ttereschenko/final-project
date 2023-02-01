import './jquery.min';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('#country-dropdown').on('change', function () {
        let idCountry = this.value;

        $("#city-dropdown").html('');
        $.ajax({
            url: '/announcements/create/fetch-cities',
            type: "POST",
            data: {
                country_id: idCountry,
            },
            dataType: 'json',
            success: function (result) {
                $('#city-dropdown').html(`<option selected disabled class="">Select City</option>`);
                $.each(result.city, function (key, value) {
                    $("#city-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

$(document).ready(function () {
    $('#country-edit-dropdown').on('change', function () {
        let idCountry = this.value;

        $("#city-edit-dropdown").html('');
        $.ajax({
            url: '/announcements/{property}/edit/fetch-cities',
            type: "POST",
            data: {
                country_id: idCountry,
            },
            dataType: 'json',
            success: function (result) {
                $('#city-edit-dropdown').html(`<option selected disabled class="">Select City</option>`);
                $.each(result.city, function (key, value) {
                    $("#city-edit-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

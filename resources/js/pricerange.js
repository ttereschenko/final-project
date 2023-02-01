import './jquery.min';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('#min-price').on('change', function () {
        let min = this.value;
        console.log(min);
        $("#min-value").html(`<span id="min-value">$ ${min}</span>`);
    });

    $('#max-price').on('change', function () {
        let max = this.value;
        console.log(max);
        $("#max-value").html(`<span id="max-value">$ ${max}</span>`);
    });
});

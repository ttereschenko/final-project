import Datepicker from '../../node_modules/vanillajs-datepicker/js/Datepicker.js';

let json_data = window.disabled_dates;
let dates = [];

for (let i in json_data) {
    dates.push(json_data[i]);
}

const checkIn = document.querySelector('input[name="check_in_date"]');
new Datepicker(checkIn, {
    buttonClass: 'btn fw-light',
    datesDisabled: dates,
    clearBtn: true,
    format: 'dd M yyyy',
});

const checkOut = document.querySelector('input[name="check_out_date"]');
new Datepicker(checkOut, {
    buttonClass: 'btn fw-light',
    datesDisabled: dates,
    clearBtn: true,
    format: 'dd M yyyy',
});


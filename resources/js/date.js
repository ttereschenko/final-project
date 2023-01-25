import { DateRangePicker } from 'vanillajs-datepicker';

const elem = document.getElementById('datePicker');
const rangepicker = new DateRangePicker(elem, {
    buttonClass: 'btn',
    // datesDisabled: [],
    clearBtn: true,
});

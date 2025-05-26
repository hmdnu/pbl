import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Indonesian } from "flatpickr/dist/l10n/id.js";

let graduationRawDate = null;
let workRawDate = null;

const graduationInput = document.getElementById("graduation-date");
const workInput = document.getElementById("first-work-date");
const waitingPeriode = document.getElementById("waiting-period");

// Parse HTML date string to Date object
if (graduationInput.value) {
    graduationRawDate = new Date(graduationInput.value);
}

// Setup graduation date picker (display only, not editable)
flatpickr(graduationInput, {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "j F Y",
    locale: Indonesian,
    clickOpens: false,
    allowInput: false,
    defaultDate: graduationRawDate,
});

// Setup work start date picker (editable)
flatpickr(workInput, {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "j F Y",
    locale: Indonesian,
    onChange: function (selectedDates) {
        workRawDate = selectedDates[0] ?? null;
        handleDateChange();
    },
});

flatpickr("#first-institution-work-date", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "j F Y",
    locale: Indonesian,
});

// Update waiting period
function handleDateChange() {
    if (graduationRawDate && workRawDate) {
        const waitingMonths = calculateWaitingPeriodInMonths(graduationRawDate, workRawDate);
        waitingPeriode.value = `${waitingMonths}`;
    } else {
        waitingPeriode.value = "-";
    }
}

// Allow negative values
function calculateWaitingPeriodInMonths(graduation, firstWork) {
    let months = (firstWork.getFullYear() - graduation.getFullYear()) * 12;
    months += firstWork.getMonth() - graduation.getMonth();

    if (firstWork.getDate() < graduation.getDate()) {
        months--;
    }

    return months;
}

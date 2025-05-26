import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Indonesian } from "flatpickr/dist/l10n/id.js";

const selectProfessionCategory = document.getElementById("profession-category");
const btn = document.getElementById("btn");
selectProfessionCategory.addEventListener("change", (e) => {
    if (e.target.value === "3") {
        btn.textContent = "Kirim";
    } else {
        btn.textContent = "Selanjutnya";
    }
});

flatpickr("#graduation-date", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "j F Y",
    locale: Indonesian,
    allowInput: false,
    clickOpens: false,
});

function getRandomColor() {
    const letters = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

async function getAllData() {
    try {
        const response = await fetch("/dashboard/data/evaluation");
        const json = await response.json();
        console.log(json);
        return json;
    } catch (error) {
        console.error("Error fetching evaluation data:", error);
        return {};
    }
}

async function showChartsAndTable() {
    const criteriaLabels = {
        teamwork: "Kerjasama Tim",
        it_expertise: "Keahlian di bidang TI",
        foreign_language: "Kemampuan berbahasa asing (Inggris)",
        communication: "Kemampuan berkomunikasi",
        self_development: "Pengembangan diri",
        leadership: "Kepemimpinan",
        work_ethic: "Etos Kerja"
    };

    const data = await getAllData();
    const tableBody = document.querySelector("#rekap-table-body");

    let index = 1;
    for (const [key, value] of Object.entries(data)) {
        const labels = [];
        const percentages = [];

        value.forEach((item) => {
            labels.push(item.label);
            percentages.push(item.percentage);
        });

        // Render Chart
        const ctx = document.getElementById(`chart-${key}`);
        if (ctx) {
            new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            data: percentages,
                            backgroundColor: labels.map(() => getRandomColor()),
                            hoverOffset: 4
                        }
                    ]
                }
            });
        }

        // Build table row
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${index++}</td>
            <td>${criteriaLabels[key]}</td>
            <td>${getPercentageByLabel(value, "Sangat Baik")}%</td>
            <td>${getPercentageByLabel(value, "Baik")}%</td>
            <td>${getPercentageByLabel(value, "Cukup")}%</td>
            <td>${getPercentageByLabel(value, "Kurang")}%</td>
        `;
        tableBody.appendChild(row);
    }
}

function getPercentageByLabel(dataArray, label) {
    const found = dataArray.find((d) => d.label === label);
    return found ? found.percentage : 0;
}

(async function() {
    "use strict";
    feather.replace({ "aria-hidden": "true" });

    await showChartsAndTable();
})();

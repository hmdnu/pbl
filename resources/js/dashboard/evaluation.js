function getRandomColor() {
    const letters = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getQueryParams() {
    const params = new URLSearchParams(window.location.search);
    return {
        prodi: params.get("prodi"),
        tahun: params.get("tahun"),
    };
}

async function getAllData() {
    try {
        const { prodi, tahun } = getQueryParams();
        const url = new URL(
            "/dashboard/data/evaluation",
            window.location.origin
        );
        if (prodi) url.searchParams.append("prodi", prodi);
        if (tahun) url.searchParams.append("tahun", tahun);

        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error("Error fetching evaluation data:", error);
        return {};
    }
}

function getPercentageByLabel(dataArray, label) {
    const found = dataArray.find((d) => d.label === label);
    return found ? found.percentage : 0;
}

async function showChartsAndTable() {
    const criteriaLabels = {
        teamwork: "Kerjasama Tim",
        it_expertise: "Keahlian di bidang TI",
        foreign_language: "Kemampuan berbahasa asing (Inggris)",
        communication: "Kemampuan berkomunikasi",
        self_development: "Pengembangan diri",
        leadership: "Kepemimpinan",
        work_ethic: "Etos Kerja",
    };

    const data = await getAllData();
    const tableBody = document.querySelector("#rekap-table-body");
    tableBody.innerHTML = "";

    let index = 1;

    for (const [key, value] of Object.entries(data)) {
        const chartLabels = value.map((v) => v.label);
        const chartPercentages = value.map((v) => v.percentage);

        const canvas = document.getElementById(`chart-${key}`);
        if (canvas) {
            new Chart(canvas, {
                type: "pie",
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            data: chartPercentages,
                            backgroundColor: chartLabels.map(() =>
                                getRandomColor()
                            ),
                            hoverOffset: 4,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });
        }

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

(async function () {
    "use strict";
    feather.replace({ "aria-hidden": "true" });
    await showChartsAndTable();
})();

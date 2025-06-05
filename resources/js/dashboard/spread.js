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

async function getData() {
    try {
        const { prodi, tahun } = getQueryParams();
        const url = new URL("/dashboard/data/spread", window.location.origin);
        if (prodi) url.searchParams.append("prodi", prodi);
        if (tahun) url.searchParams.append("tahun", tahun);

        const response = await fetch(url);
        if (!response.ok)
            throw new Error("Gagal mengambil data spread profesi");
        return await response.json();
    } catch (error) {
        console.error(error);
        return [];
    }
}

let professionChartInstance = null;
async function showData() {
    const data = await getData();
    const labels = data.map((d) => d.profession_name);
    const values = data.map((d) => d.percentage);
    const colors = labels.map(() => getRandomColor());

    const ctx = document.getElementById("sebaran-profesi-lulusan");
    if (!ctx) {
        console.warn("Canvas #sebaran-profesi-lulusan tidak ditemukan");
        return;
    }

    if (professionChartInstance) {
        professionChartInstance.destroy();
    }

    professionChartInstance = new Chart(ctx, {
        type: "pie",
        data: {
            labels,
            datasets: [
                {
                    data: values,
                    backgroundColor: colors,
                    hoverOffset: 4,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "right",
                },
            },
        },
    });
}

async function getInstitutionTypeData() {
    try {
        const { prodi, tahun } = getQueryParams();
        const url = new URL(
            "/dashboard/data/institution-type",
            window.location.origin
        );
        if (prodi) url.searchParams.append("prodi", prodi);
        if (tahun) url.searchParams.append("tahun", tahun);

        const response = await fetch(url);
        if (!response.ok)
            throw new Error("Gagal mengambil data jenis institusi");
        return await response.json();
    } catch (error) {
        console.error(error);
        return [];
    }
}

let institutionChartInstance = null;
async function showInstitutionTypeData() {
    const data = await getInstitutionTypeData();
    const labels = data.map((d) => d.institution_name);
    const values = data.map((d) => d.percentage);
    const colors = labels.map(() => getRandomColor());

    const ctx = document.getElementById("sebaran-institution-type");
    if (!ctx) {
        console.warn("Canvas #sebaran-institution-type tidak ditemukan");
        return;
    }

    if (institutionChartInstance) {
        institutionChartInstance.destroy();
    }

    institutionChartInstance = new Chart(ctx, {
        type: "pie",
        data: {
            labels,
            datasets: [
                {
                    data: values,
                    backgroundColor: colors,
                    hoverOffset: 4,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "right",
                },
            },
        },
    });
}


(async function() {
    "use strict";
    feather.replace({ "aria-hidden": "true" });

    await showData();
    await showInstitutionTypeData();

})();

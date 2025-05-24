function getRandomColor() {
    const letters = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

async function getData() {
    try {
        const data = await fetch("/dashboard/data/spread");
        return await data.json();
    } catch (error) {
        console.error(error);
    }
}

async function showData() {
    const datasets = {
        labels: [],
        data: [],
    };
    const data = await getData();
    data.map((d) => {
        datasets.labels.push(d.profession_name);
        datasets.data.push(d.percentage);
    });

    const backgroundColors = datasets.labels.map(() => getRandomColor());

    // Graphs
    var ctx = document.getElementById("sebaran-profesi-lulusan");
    // eslint-disable-next-line no-unused-vars
    new Chart(ctx, {
        type: "pie",
        data: {
            labels: datasets.labels,
            datasets: [
                {
                    data: datasets.data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 4,
                },
            ],
        },
    });
}

(async function () {
    "use strict";
    feather.replace({ "aria-hidden": "true" });

    await showData();
})();

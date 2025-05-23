/* globals Chart:false, feather:false */

(async function () {
    "use strict";
    feather.replace({ "aria-hidden": "true" });

    const datasets = {
        labels: [],
        data: [],
    };
    const data = await getData();
    data.map((d) => {
        datasets.labels.push(d.title);
        datasets.data.push(d.count);
    });

    // Graphs
    var ctx = document.getElementById("myChart");
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: datasets.labels,
            datasets: [
                {
                    label: "My First Dataset",
                    data: datasets.data,
                    backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"],
                    hoverOffset: 4,
                },
            ],
        },
    });
})();

async function getData() {
    try {
        const data = await fetch("/dashboard/data/spread");
        return await data.json();
    } catch (error) {
        console.error(error);
    }
}

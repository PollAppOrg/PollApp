const ctx = document.getElementById('myChart').getContext('2d');


const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [
                    12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,
        interaction: {
            enabled: false
        },
        plugins:{

            legend: {
                display: false
            }
        },
        scales: {
            x: {
                display: false,
                grid: {
                    display: false
                }
            },
            y: {
                display: false,
                grid: {
                    display: false
                },
                beginAtZero: true
            }
        }
    }
});

function randomChart() {
    chart.data.datasets.forEach(dataset => {
        dataset.data = numbers({count: chart.data.labels.length, min: 0, max: 20});
    });
    chart.update();
}

setInterval(randomChart,900)


function numbers(config) {
    var cfg = config || {};
    var min = cfg.min;
    var from = [];
    var max = cfg.max;
    var count = cfg.count;
    var data = [];
    var i, value;
  
    for (i = 0; i < count; ++i) {
        value = (from[i] || 0) + (Math.random() * (max - min) + min);
        data.push(value);
    }
  
    return data;
  }




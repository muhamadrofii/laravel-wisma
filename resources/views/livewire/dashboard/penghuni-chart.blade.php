<div style="width: 100%; max-width: 768px; height: 350px; margin: auto;">
    <canvas id="penghuniChartCanvas"></canvas>
</div>

<!-- Chart.js dan Plugin DataLabels -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('penghuniChartCanvas').getContext('2d');

        const labels = @json($weeklyLabels);
        const data = @json($data);
        const penginapanLabels = @json($labels);

        const backgroundColors = ['#4e79a7', '#f28e2b', '#e15759'];

        const datasets = penginapanLabels.map((label, index) => ({
            label: label,
            data: data[index],
            backgroundColor: backgroundColors[index % backgroundColors.length],
            borderColor: '#cccccc',
            borderWidth: 1
        }));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            padding: 25 // jarak antara bar dan label Y (wisma)
                        }

                    },
                    y: {
                        beginAtZero: true,
                        max: 20,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    },
                    datalabels: {
                        color: '#000',
                        anchor: 'end',
                        align: 'start',
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: function(value) {
                            return value;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

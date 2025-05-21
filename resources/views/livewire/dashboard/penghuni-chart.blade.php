<div style="width: 100%; max-width: 768px; height: 350px; margin: auto;">
    <canvas id="penghuniChartCanvas"></canvas>
</div>

<!-- Chart.js dan Plugin DataLabels -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('penghuniChartCanvas').getContext('2d');

        // Data dari backend
        const labels = @json($weeklyLabels);
        const datasets = @json($labels).map((label, index) => {
            return {
                label: label,
                data: @json($data)[index],
                backgroundColor: 'rgba(100, 149, 237, 0.6)', // Cornflower Blue
                borderColor: 'rgba(100, 149, 237, 1)',
                borderWidth: 1
            };
        });

        // Inisialisasi chart
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
                        display: false // Sembunyikan label X
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
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
                            size: 14
                        },
                        formatter: function(value) {
                            return value; // Tampilkan nilai seperti "15" di atas bar
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Data Postingan</h5>
                    <div id="line-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Gender</h5>
                    <div id="pie-chart"></div>
                </div>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Data gender yang diterima dari controller
        var maleCount = {{ $maleCount }};
        var femaleCount = {{ $femaleCount }};

        var options = {
            series: [maleCount, femaleCount], // Data dari controller
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Male', 'Female'], // Label gender
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();
    </script>

    <script>
        // Data posts per bulan yang diterima dari controller
        var postsPerMonth = @json($postsPerMonth); // Mengambil data dari controller
        var months = @json($months); // Bulan untuk x-axis

        var options = {
            series: [{
                name: 'Posts',
                data: postsPerMonth // Data jumlah post per bulan
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            forecastDataPoints: {
                count: 7
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            xaxis: {
                type: 'category', // Menggunakan kategori karena bulan sudah ditentukan
                categories: months, // Bulan sebagai kategori di x-axis
                tickAmount: 6, // Menampilkan 6 ticks (untuk 6 bulan)
            },
            title: {
                // text: 'Jumlah Posts per Bulan (Jul - Des)',
                align: 'left',
                style: {
                    fontSize: "16px",
                    color: '#666'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: ['#FDD835'],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart"), options);
        chart.render();
    </script>
@endsection

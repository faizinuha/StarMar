@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Card for Total Posts -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Total Posts</h5>
                    <h3>{{ $totalPosts }}</h3> <!-- Display the total number of posts -->
                </div>
            </div>
        </div>

        <!-- Card for Total Users -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3>{{ $totalUsers }}</h3> <!-- Display the total number of users -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card for Posts Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Data Postingan</h5>
                    <div id="line-chart"></div>
                </div>
            </div>
        </div>

        <!-- Card for Gender Distribution -->
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
            series: [maleCount, femaleCount],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Male', 'Female'],
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
        var postsPerMonth = @json($postsPerMonth);
        var months = @json($months);

        var options = {
            series: [{
                name: 'Posts',
                data: postsPerMonth
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
                type: 'category',
                categories: months,
                tickAmount: 6,
            },
            title: {
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

$(function () {
  //
  // Carousel
  //
  $(".counter-carousel").owlCarousel({
    loop: true,
    margin: 30,
    mouseDrag: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplaySpeed: 2000,
    nav: false,
    rtl: true,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      1200: {
        items: 5,
      },
      1400: {
        items: 6,
      },
    },
  });
  // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      {
        name: "Eanings this month",
        data: [1.5, 2.7, 2.2, 3.6, 1.5, 1.0],
      },
      {
        name: "Expense this month",
        data: [-1.8, -1.1, -2.5, -1.5, -0.6, -1.8],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 320,
      stacked: true,
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    yaxis: {
      min: -5,
      max: 5,
      title: {
        // text: 'Age',
      },
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      categories: [
        "16/08",
        "17/08",
        "18/08",
        "19/08",
        "20/08",
        "21/08",
        "22/08",
      ],

    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();

  // =====================================
  // Breakup
  // =====================================
  var breakup = {
    color: "#adb5bd",
    series: [38, 40, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["var(--bs-primary)", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 120,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();

  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "var(--bs-secondary)",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.15,
        opacityTo: 0,
        stops: [20, 180],
      },
      opacity:0.5
    },


    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();

  // =====================================
  // Salary
  // =====================================
  var salary = {
    series: [
      {
        name: "Employee Salary",
        data: [20, 15, 30, 25, 10, 15],
      },
    ],

    chart: {
      toolbar: {
        show: false,
      },
      height: 260,
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    colors: ["#f2f6fad9", "#f2f6fad9", "var(--bs-primary)", "#f2f6fad9", "#f2f6fad9", "#f2f6fad9"],
    plotOptions: {
      bar: {
        borderRadius: 4,
        columnWidth: "45%",
        distributed: true,
        endingShape: "rounded",
      },
    },

    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      categories: [["Apr"], ["May"], ["June"], ["July"], ["Aug"], ["Sept"]],
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#salary"), salary);
  chart.render();

  // =====================================
  // Customers
  // =====================================
  var customers = {
    chart: {
      id: "sparkline3",
      type: "area",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
    },
    series: [
      {
        name: "Customers",
        color: "var(--bs-secondary)",
        data: [30, 25, 35, 20, 30, 40],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.12,
        opacityTo: 0,
        stops: [20, 180],
      },
    },


    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#customers"), customers).render();

  // =====================================
  // Projects
  // =====================================
  var projects = {
    series: [
      {
        name: "",
        data: [4, 10, 9, 7, 9, 10, 11, 8, 10, 9],
      },
    ],
    chart: {
      type: "bar",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 60,

      resize: true,
      barColor: "#fff",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["var(--bs-primary)"],
    grid: {
      show: false,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        startingShape: "flat",
        endingShape: "flat",
        columnWidth: "60%",
        barHeight: "20%",
        endingShape: "rounded",
        distributed: true,
        borderRadius: 2,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2.5,
      colors: ["rgba(0,0,0,0.01)"],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    axisBorder: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      style: {
        fontSize: "12px",
      },
      x: {
        show: false,
      },
    },
  };

  var chart_column_basic = new ApexCharts(
    document.querySelector("#projects"),
    projects
  );
  chart_column_basic.render();

  // =====================================
  // Stats
  // =====================================
  var stats = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 180,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Weekly Stats",
        color: "var(--bs-primary)",
        data: [5, 15, 10, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.20,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#stats"), stats).render();
});

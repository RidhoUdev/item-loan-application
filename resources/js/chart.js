document.addEventListener('DOMContentLoaded', function () {
    const loanDates = window.dashboardChartData?.loanDates || [];
    const loanCounts = window.dashboardChartData?.loanCounts || [];
    const topItemNames = window.dashboardChartData?.topItemNames || [];
    const topItemCounts = window.dashboardChartData?.topItemCounts || [];

    const daisyUIColors = {
        primary: '#570DF8', // warna tema by DaisyUi
        secondary: '#F000B8',
        accent: '#37CDBE',
        neutral: '#3D4451',
        info: '#3ABFF8',
        success: '#36D399',
        warning: '#FBBD23',
        error: '#F87272',
    };

    // 1. Chart Frekuensi Peminjaman
    const loanFrequencyChartEl = document.querySelector("#loanFrequencyChart");
    if (loanFrequencyChartEl) {
        if (loanDates.length > 0 && loanCounts.length > 0) {
            var loanFrequencyOptions = {
                series: [{
                    name: 'Jumlah Peminjaman',
                    data: loanCounts
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: true,
                        tools: { download: true, selection: false, zoom: false, zoomin: false, zoomout: false, pan: false, reset: false }
                    }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3, colors: [daisyUIColors.primary] },
                title: { text: 'Peminjaman per Hari', align: 'left', style: { fontSize: '14px', fontWeight: 'bold', color: '#263238' } },
                grid: { row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.5 } },
                xaxis: { categories: loanDates, title: { text: 'Tanggal' } },
                yaxis: {
                    title: { text: 'Jumlah Permintaan' },
                    min: 0,
                    labels: { formatter: function (val) { return Math.floor(val); } },
                    tickAmount: 5
                },
                tooltip: { y: { formatter: function (val) { return val + " permintaan" } } }
            };
            var loanFrequencyChart = new ApexCharts(loanFrequencyChartEl, loanFrequencyOptions);
            loanFrequencyChart.render();
        } else {
            loanFrequencyChartEl.innerHTML = '<p class="text-center text-gray-500 py-10">Data frekuensi peminjaman belum cukup.</p>';
        }
    }

    // 2. Chart Barang Paling Sering Dipinjam
    const topItemsChartEl = document.querySelector("#topItemsChart");
    if (topItemsChartEl) {
        if (topItemNames.length > 0 && topItemCounts.length > 0) {
            var topItemsOptions = {
                series: [{
                    name: 'Total Dipinjam',
                    data: topItemCounts
                }],
                chart: { type: 'bar', height: 350, toolbar: { show: true, tools: { download: true, selection: false, zoom: false, zoomin: false, zoomout: false, pan: false, reset: false } } },
                plotOptions: { bar: { borderRadius: 4, horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
                dataLabels: { enabled: false },
                stroke: { show: true, width: 2, colors: ['transparent'] },
                xaxis: { categories: topItemNames, title: { text: 'Nama Barang' } },
                yaxis: {
                    title: { text: 'Jumlah Siklus Unit Dipinjam' },
                    min: 0,
                    labels: { formatter: function (val) { return Math.floor(val); } },
                    tickAmount: 5
                },
                colors: [daisyUIColors.accent],
                fill: { opacity: 1 },
                tooltip: { y: { formatter: function (val) { return val + " peminjaman" } } },
                title: { text: 'Barang Terpopuler', align: 'left', style: { fontSize: '14px', fontWeight: 'bold', color: '#263238' } },
            };
            var topItemsChart = new ApexCharts(topItemsChartEl, topItemsOptions);
            topItemsChart.render();
        } else {
            topItemsChartEl.innerHTML = '<p class="text-center text-gray-500 py-10">Data barang paling sering dipinjam belum tersedia.</p>';
        }
    }
});

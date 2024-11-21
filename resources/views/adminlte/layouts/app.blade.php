<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cuti Pegawai{{ $title ?? "" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/img/favicon//favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('/assets/img/favicon/site.webmanifest')}}">
    {{-- <link rel="shortcut icon" href="{{ asset('/assets/img/favicon/rri-logo-2.png') }}" type="image/x-icon"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/addOn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <style>
        .search-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    
        .search-container .search-input {
            margin-right: 1vw; /* Adjust the margin as needed */
        }
    </style>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->

  {{-- Main Header Container --}}
  @include('frontUI/header')

  <!-- Main Sidebar Container -->
  @include('frontUI/sidebar')

  @yield('content')

  {{-- Main Footer --}}
  @include('frontUI/footer')

</div>
</body>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/js/addOn.js') }}"></script>     
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script> <!-- sortablejs -->
<script>
    const connectedSortables =
        document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
            group: "shared",
            handle: ".card-header",
        });
    });

    const cardHeaders = document.querySelectorAll(
        ".connectedSortable .card-header",
    );
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = "move";
    });
</script> <!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->
<script>
    (() => {
        "use strict";

        const forms =
            document.querySelectorAll(".needs-validation");

        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
    
</script>

{{-- TEST SCRIPT --}}

<script>
    // Fungsi untuk mendapatkan akhir bulan setiap periode
    function getEndOfMonthDates(fromMonth, toMonth) {
        const dates = [];
        const fromDate = new Date(`${fromMonth}-01`);
        const toDate = new Date(`${toMonth}-01`);
        const currentDate = new Date(fromDate);
        while (currentDate <= toDate) {
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1); // Akhir bulan
            dates.push(lastDay.toISOString().split('T')[0]);
            currentDate.setMonth(currentDate.getMonth() + 1);
        }
        return dates;
    }

    // Fungsi untuk memfilter data cuti (sales_chart)
    function getFilteredCutiData(dataCuti, fromMonth, toMonth) {
        const filteredCutiData = [];
        const fromDate = new Date(`${fromMonth}-01`);
        const toDate = new Date(`${toMonth}-01`);
        const currentDate = new Date(fromDate);
        while (currentDate <= toDate) {
            const yearMonth = currentDate.toISOString().slice(0, 7);
            filteredCutiData.push(dataCuti[yearMonth] || 0);
            currentDate.setMonth(currentDate.getMonth() + 1);
        }
        console.log("Filtered Cuti Data:", filteredCutiData);
        return filteredCutiData;
    }

    // Fungsi untuk memfilter data jabatan (visitors_chart)
    function getFilteredJabatanData(jabatanCuti, fromMonth, toMonth) {
        const filteredJabatanData = [];
        const fromDate = new Date(`${fromMonth}-01`);
        const toDate = new Date(`${toMonth}-01`);
        const currentDate = new Date(fromDate);
        while (currentDate <= toDate) {
            const yearMonth = currentDate.toISOString().slice(0, 7);
            filteredJabatanData.push(jabatanCuti[yearMonth] || {});
            currentDate.setMonth(currentDate.getMonth() + 1);
        }
        return filteredJabatanData;
    }

    // Fungsi untuk mendapatkan nilai maksimum
    function getMaxValue(data) {
        return Math.max(...data);
    }

    // Opsi untuk sales chart
    const sales_chart_options = {
        series: [{
            name: "Pegawai Cuti",
            data: getFilteredCutiData(dataCuti, "2024-01", "2024-12"),
        }],
        chart: {
            height: 320,
            type: "area",
        },
        xaxis: {
            categories: getEndOfMonthDates("2024-01", "2024-12"),
            labels: {
                formatter: function(value) {
                    const date = new Date(value);
                    return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                }
            }
        },
        colors: ["#0d6efd"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "straight",
        },
    };

    // Opsi untuk visitors chart
    const visitors_chart_options = {
        series: [
            {
                name: "Pranata Siaran Ahli Madya",
                data: getFilteredJabatanData(jabatanCuti, "2024-01", "2024-12").map(item => item["pranata_siaran_ahli_madya"] || 0),
            },
            {
                name: "Pranata Siaran Ahli Muda",
                data: getFilteredJabatanData(jabatanCuti, "2024-01", "2024-12").map(item => item["pranata_siaran_ahli_muda"] || 0),
            },
            {
                name: "Teknisi Siaran Ahli Madya",
                data: getFilteredJabatanData(jabatanCuti, "2024-01", "2024-12").map(item => item["teknisi_siaran_ahli_madya"] || 0),
            },
            {
                name: "Teknisi Siaran Ahli Muda",
                data: getFilteredJabatanData(jabatanCuti, "2024-01", "2024-12").map(item => item["teknisi_siaran_ahli_muda"] || 0),
            },
        ],
        chart: {
            height: 320,
            type: "bar",
        },
        xaxis: {
            categories: getEndOfMonthDates("2024-01", "2024-12",),
            labels: {
                formatter: function(value) {
                    const date = new Date(value);
                    return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                }
            }
        },
        colors: ["#0d6efd", "#20c997", "#ffc107", "#e83e8c"],
        dataLabels: {
            enabled: false,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
    };

    // Opsi untuk pie chart
    const currentMonth = new Date().toISOString().slice(0, 7); // Ambil bulan saat ini
    
    const pie_chart_options = {
        series: Object.values(jabatanCuti[currentMonth] || {}),
        chart: {
            type: "donut",
            height: 320,
        },
        labels: Object.keys(jabatanCuti[currentMonth] || {}).map(key => key.replace(/_/g, ' ')),
        colors: [
            "#1E88E5", "#43A047", "#FFA726", "#E53935", "#8E24AA", "#00ACC1",
            "#FFD600", "#886342", "#00BFA5", "#F4511E", "#7CB342", "#5E35B1"
        ],
        dataLabels: {
            enabled: false,
        },
    };

    // Render charts
    const sales_chart = new ApexCharts(document.querySelector("#sales-chart"), sales_chart_options);
    const visitors_chart = new ApexCharts(document.querySelector("#visitors-chart"), visitors_chart_options);
    const pie_chart = new ApexCharts(document.querySelector("#pie-chart"), pie_chart_options);

    sales_chart.render();
    visitors_chart.render();
    pie_chart.render();

    // Fungsi untuk memperbarui semua chart berdasarkan filter
    function updateChart() {
        const fromMonth = document.getElementById("from-month").value;
        const toMonth = document.getElementById("to-month").value;

        if (fromMonth && toMonth) {
            const newCategories = getEndOfMonthDates(fromMonth, toMonth);

            // Perbarui sales_chart
            const newSalesData = getFilteredCutiData(dataCuti, fromMonth, toMonth);
            sales_chart.updateOptions({
                series: [{ data: newSalesData }],
                xaxis: {
                    categories: newCategories,
                    labels: {
                        formatter: function(value) {
                            const date = new Date(value);
                            return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                        }
                    }
                },
            });

            // Perbarui visitors_chart
            const newVisitorsData = getFilteredJabatanData(jabatanCuti, fromMonth, toMonth);
            visitors_chart.updateOptions({
                series: [
                    { name: "Pranata Siaran Ahli Madya", data: newVisitorsData.map(item => item["pranata_siaran_ahli_madya"] || 0) },
                    { name: "Pranata Siaran Ahli Muda", data: newVisitorsData.map(item => item["pranata_siaran_ahli_muda"] || 0) },
                    { name: "Teknisi Siaran Ahli Madya", data: newVisitorsData.map(item => item["teknisi_siaran_ahli_madya"] || 0) },
                    { name: "Teknisi Siaran Ahli Muda", data: newVisitorsData.map(item => item["teknisi_siaran_ahli_muda"] || 0) },
                ],
                xaxis: {
                    categories: newCategories,
                    labels: {
                        formatter: function(value) {
                            const date = new Date(value);
                            return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                        }
                    }
                },
            });

            // Perbarui pie_chart
            const pieData = jabatanCuti[currentMonth] || {};
            pie_chart.updateOptions({
                series: Object.values(pieData),
                labels: Object.keys(pieData).map(key => key.replace(/_/g, ' ')),
            });

            const dateRangeTitle = document.getElementById('date-range-title');
            const fromDate = new Date(`${fromMonth}-01`);
            const toDate = new Date(`${toMonth}-01`);
            const fromDateString = fromDate.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
            const toDateString = new Date(toDate.getFullYear(), toDate.getMonth() + 1, 0).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
            dateRangeTitle.innerHTML = `<strong>Cuti: ${fromDateString} - ${toDateString}</strong>`;
        }
    }
</script>


<!--end::JavaScript-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('myTable');
        if (!table) {
            console.error('Table with ID "myTable" not found.');
            return;
        }

        const rows = table.querySelectorAll('tbody tr');
        const searchInput = document.getElementById('searchInput');
        const searchToggle = document.getElementById('searchToggle');
        let searchVisible = false;

        // Toggle to show/hide search input
        searchToggle.addEventListener('click', function() {
            searchVisible = !searchVisible;
            searchInput.style.display = searchVisible ? 'inline-block' : 'none';
        });

        // Function to filter table rows based on partial matching
        function updateTable() {
            const filter = searchInput.value.toLowerCase().trim();

            rows.forEach(row => {
                const shouldShow = Array.from(row.children).slice(1, -1).some(cell => {
                    const cellText = cell.textContent.toLowerCase().trim();
                    return cellText.includes(filter);
                });
                row.style.display = shouldShow ? '' : 'none';
            });
        }

        // Attach event listener to search input for real-time filtering
        searchInput.addEventListener('input', updateTable);

        // Sorting functionality (optional)
        const headers = table.querySelectorAll('th.sortable');
        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const isAscending = header.classList.contains('asc');
                const sortedRows = Array.from(rows).sort((a, b) => {
                    const aValue = a.children[index].textContent.trim();
                    const bValue = b.children[index].textContent.trim();
                    return isAscending ? bValue.localeCompare(aValue) : aValue.localeCompare(bValue);
                });

                sortedRows.forEach(row => table.querySelector('tbody').appendChild(row));

                headers.forEach(h => h.classList.remove('asc', 'desc'));
                header.classList.toggle('asc', !isAscending);
                header.classList.toggle('desc', isAscending);
            });
        });

        const downloadButton = document.getElementById('downloadDoc');
        const monthSelect = document.getElementById('monthSelect');
        const yearInput = document.getElementById('yearInput');

        // Set tahun default ke tahun sekarang
        const currentYear = new Date().getFullYear();
        yearInput.value = currentYear;

        // Set min dan max untuk input tahun
        yearInput.min = "2000"; // Sesuaikan dengan kebutuhan
        yearInput.max = currentYear.toString();

        if (downloadButton && monthSelect && yearInput) {
            downloadButton.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedMonth = monthSelect.value;
                const selectedYear = yearInput.value;

                if (selectedMonth && selectedYear) {
                    if (selectedYear < 2000 || selectedYear > currentYear) {
                        alert('Silakan masukkan tahun antara 2000 dan ' + currentYear);
                    } else {
                        window.location.href = `/generate-pdf?month=${selectedMonth}&year=${selectedYear}`;
                    }
                } else {
                    alert('Silakan pilih bulan dan masukkan tahun sebelum mengunduh.');
                }
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->    
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->
</body>
</html>

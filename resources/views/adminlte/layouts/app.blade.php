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
        document.getElementById('filter-toggle').addEventListener('click', function() {
            const filterForm = document.getElementById('filter-form');
            filterForm.style.display = filterForm.style.display === 'none' ? 'block' : 'none';
        });

        function getEndOfMonthDates(fromMonth, toMonth) {
            const dates = [];
            const fromDate = new Date(`${fromMonth}-01`);
            const toDate = new Date(`${toMonth}-01`);
            const currentDate = fromDate;
            while (currentDate <= toDate) {
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0); // Akhir bulan
                const adjustedDay = new Date(lastDay.setDate(lastDay.getDate() - 1)); // Kurangi satu hari
                dates.push(adjustedDay.toISOString().split('T')[0]);
                currentDate.setMonth(currentDate.getMonth() + 1);
            }
            return dates;
        }

        function getFilteredData(dataCuti, fromMonth, toMonth) {
            const data = [];
            const fromDate = new Date(`${fromMonth}-01`);
            const toDate = new Date(`${toMonth}-01`);
            const currentDate = new Date(fromDate);
            while (currentDate <= toDate) {
                const yearMonth = currentDate.toISOString().split('T')[0].slice(0, 7);
                data.push(dataCuti[yearMonth] || 0);
                currentDate.setMonth(currentDate.getMonth() + 1);
            }
            return data;
        }

        function getMonthLabels(fromMonth, toMonth) {
            const labels = [];
            const fromDate = new Date(`${fromMonth}-01`);
            const toDate = new Date(`${toMonth}-01`);
            const currentDate = fromDate;
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            while (currentDate <= toDate) {
                labels.push(monthNames[currentDate.getMonth()]);
                currentDate.setMonth(currentDate.getMonth() + 1);
            }
            return labels;
        }

        function getMaxValue(data) {
            return Math.max(...data);
        }

        const initialFromMonth = "2024-01";
        const initialToMonth = "2024-12";
        const initialData = getFilteredData(dataCuti, initialFromMonth, initialToMonth);
        const maxValue = getMaxValue(initialData);

        const sales_chart_options = {
            series: [{
                name: "Pegawai Cuti",
                data: initialData, // Data dari database
            }],
            chart: {
                height: 320,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight", // Garis lurus
            },
            xaxis: {
                categories: getEndOfMonthDates(initialFromMonth, initialToMonth), // Default range
                labels: {
                    formatter: function(value) {
                        const date = new Date(value);
                        return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
                    }
                }
            },
            yaxis: {
                max: maxValue, // Atur maksimum sumbu y menjadi 9 kali lipat dari nilai tertinggi
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0); // Menghilangkan angka desimal
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value.toFixed(0); // Menghilangkan angka desimal
                    }
                }
            },
        };

        const pie_chart_options = {
            series: initialData, // Data dari database
            chart: {
                type: "donut",
            },
            labels: getMonthLabels(initialFromMonth, initialToMonth), // Label default
            dataLabels: {
                enabled: false,
            },
            colors: [
                "#1E88E5", "#43A047", "#FFA726", "#E53935", "#8E24AA", "#00ACC1",
                "#FFD600", "#886342", "#00BFA5", "#F4511E", "#7CB342", "#5E35B1"
            ],
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value.toFixed(0); // Menghilangkan angka desimal
                    }
                }
            },
        };

        const sales_chart = new ApexCharts(document.querySelector("#sales-chart"), sales_chart_options);
        const pie_chart = new ApexCharts(document.querySelector("#pie-chart"), pie_chart_options);

        sales_chart.render();
        pie_chart.render();

        function updateChart() {
            const fromMonth = document.getElementById('from-month').value;
            const toMonth = document.getElementById('to-month').value;
            if (fromMonth && toMonth) {
                const newCategories = getEndOfMonthDates(fromMonth, toMonth);
                const newData = getFilteredData(dataCuti, fromMonth, toMonth);
                const newLabels = getMonthLabels(fromMonth, toMonth);
                const newMaxValue = getMaxValue(newData);

                sales_chart.updateOptions({
                    xaxis: {
                        categories: newCategories
                    },
                    series: [{
                        data: newData
                    }],
                    yaxis: {
                        max: newMaxValue,  // Atur maksimum sumbu y menjadi 9 kali lipat dari nilai tertinggi
                    }
                });

                pie_chart.updateOptions({
                    series: newData,
                    labels: newLabels
                });

                // Update title
                const dateRangeTitle = document.getElementById('date-range-title');
                const fromDate = new Date(`${fromMonth}-01`);
                const toDate = new Date(`${toMonth}-01`);
                const fromDateString = fromDate.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
                const toDateString = new Date(toDate.getFullYear(), toDate.getMonth() + 1, 0).toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
                dateRangeTitle.innerHTML = `<strong>Cuti: 1 ${fromDateString} - ${toDate.getDate()} ${toDateString}</strong>`;
            }
        }

    </script>

    <!--end::JavaScript-->
    {{-- <script>
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

        // $(document).ready(function() {
        //     var table = $('#myTable').DataTable({
        //         "order": [], // Disable initial sort
        //         "columnDefs": [
        //             { "orderable": false, "targets": 8 } // Disable sorting on the last column (Selengkapnya)
        //         ]
        //     });

        //     // Tambahkan event listener untuk klik pada header
        //     $('#myTable thead th.sortable').on('click', function() {
        //         var columnIndex = $(this).index();
        //         var currentOrder = table.order()[0];

        //         if (currentOrder[0] === columnIndex) {
        //             // Jika kolom ini sudah diurutkan, balik urutannya
        //             table.order([columnIndex, currentOrder[1] === 'asc' ? 'desc' : 'asc']).draw();
        //         } else {
        //             // Jika belum, urutkan secara ascending
        //             table.order([columnIndex, 'asc']).draw();
        //         }

        //         // Update indikator visual
        //         $('#myTable thead th.sortable').removeClass('asc desc');
        //         if (table.order()[0][1] === 'asc') {
        //             $(this).addClass('asc');
        //         } else {
        //             $(this).addClass('desc');
        //         }
        //     });
            
        // });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->     --}}
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->
</body>
</html>

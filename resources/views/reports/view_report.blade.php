@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Reports For Sales <span
                    class="font-weight-bold text-primary">{{ $sales->name }}</span></h1>
            <a href="javascript:void(0);" onclick="printReport()"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <h1 class="h3 mb-2 text-gray-800"> </h1>

        <div class="row">

            <!-- All Deals -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    All Deals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $deals_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-handshake fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ url('/reports/details-deals/' . $sales->id) }}" class="btn btn-sm btn-primary mt-2">More
                            Info</a>
                    </div>
                </div>
            </div>

            <!-- All Accounts -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    All Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $accounts_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ url('/reports/details-accounts/' . $sales->id) }}"
                            class="btn btn-sm btn-success mt-2">More Info</a>
                    </div>
                </div>
            </div>

            <!-- All Contacts -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All Contacts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $contacts_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ url('/reports/details-contacts/' . $sales->id) }}" class="btn btn-sm btn-info mt-2">More
                            Info</a>
                    </div>
                </div>
            </div>

            <!-- All Prospects -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    All Prospects</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prospects_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ url('/reports/details-prospects/' . $sales->id) }}"
                            class="btn btn-sm btn-warning mt-2">More Info</a>
                    </div>
                </div>
            </div>

            <!-- Activity Sales -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Activity Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_activities }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href=" {{ url('/reports/details-activities/' . $sales->id) }} "
                            class="btn btn-sm btn-danger mt-2">More Info</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Total Amount Overview</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Filter Periode:</div>
                                <a class="dropdown-item" href="#" onclick="updateChart('1_week')">1 Minggu</a>
                                <a class="dropdown-item" href="#" onclick="updateChart('1_month')">1 Bulan</a>
                                <a class="dropdown-item" href="#" onclick="updateChart('3_month')">3 Bulan</a>
                                <a class="dropdown-item" href="#" onclick="updateChart('1_year')">1 Tahun</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="detailAmountChart"></canvas>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Prospect Sources</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Options:</div>
                                <a class="dropdown-item" href="#">View Details</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="prospectSourceChart"
                                data-advertising="{{ $prospect_sources['Advertising'] ?? 0 }}"
                                data-social-media="{{ $prospect_sources['Social Media'] ?? 0 }}"
                                data-direct-call="{{ $prospect_sources['Direct Call'] ?? 0 }}"
                                data-search="{{ $prospect_sources['Search'] ?? 0 }}">
                            </canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Advertising
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social Media
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-danger"></i> Direct Call
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Search
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        var myLineChart;
        var salesId = {{ $sales->id }};
        // Set default font family dan font color agar menyerupai styling Bootstrap
        Chart.defaults.global.defaultFontFamily =
            'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Fungsi untuk memformat angka
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }



        function initializeChart(labels, data) {
            var ctx = document.getElementById("detailAmountChart").getContext("2d");

            // Hancurkan chart sebelumnya jika ada
            if (myLineChart) {
                myLineChart.destroy();
            }

            myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Total Amount",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return 'Rp' + number_format(value, 0, ',', '.');
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel, 0, ',', '.');
                            }
                        }
                    }
                }
            });
        }

        function updateChart(filter) {
            $.ajax({
                url: '/reports/chart-data/' + salesId,
                method: 'GET',
                data: {
                    filter: filter
                },
                success: function(response) {
                    initializeChart(response.labels, response.data);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function printReport() {
            window.print();
        }
    </script>

    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            updateChart('1_month'); // Memastikan updateChart berjalan setelah DOM siap
        });
    </script>
@endsection

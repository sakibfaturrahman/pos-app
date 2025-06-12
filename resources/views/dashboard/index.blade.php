@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body">
                        <h5><span id="hai"></span>,<br> <strong>{{ Auth::user()->name }}</strong> 🎉</h5>
                        <p class="card-text font-small-3">Kamu login sebagai <strong>{{ Auth::user()->role->role }}</strong>
                            sekarang</p>
                        <a href="{{ route('detail_transaksi.baru') }}" class="btn btn-primary">Transaksi</a>
                        {{-- <img src="{{ asset('/') }}backend/app-assets/images/illustration/badge.svg"
                            class="congratulation-medal" alt="Medal Pic" /> --}}
                    </div>
                </div>
            </div>
            <!--/ Medal Card -->
            <!-- Statistics Card -->
            <div class="col-xl-9 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text -2 mr-25 mb-0"><span id="tanggal"></span></p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ format_uang($pemasukan) }}</h4>
                                        <p class="card-text font-small-3 mb-0">Total pendapatan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="media">
                                    <div class="avatar bg-light-danger mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-down" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ format_uang($pengeluaran) }}</h4>
                                        <p class="card-text font-small-3 mb-0">Pengeluaran</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="truck" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $supplier }}</h4>
                                        <p class="card-text font-small-3 mb-0">Supplier</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-success mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="shopping-bag" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $produk }}</h4>
                                        <p class="card-text font-small-3 mb-0">Produk</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
            <div class="col-lg-12 col-6">
                <div class="row match-height">
                </div>
            </div>
            <!-- Revenue Report Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-revenue-budget">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="card-header">
                                    <h3 class="card-title">Grafik Pendapatan {{ tanggal_indonesia($tanggal_awal, false) }}
                                        s/d
                                        {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="chart">
                                                <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" style="height: 180px;"></canvas>
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
@push('scripts')
    <script>
        function updateDateAndTime() {
            let currentDateTime = new Date();
            let tanggalSpan = document.getElementById("tanggal");
            let jamSpan = document.getElementById("jam");

            let options = {
                timeZone: "Asia/Jakarta",
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
            };
            let formatter = new Intl.DateTimeFormat("id-ID", options);

            let formattedDate = formatter.format(currentDateTime);

            tanggalSpan.textContent = "" + formattedDate;
            jamSpan.textContent = "" + formattedDate;
        }

        setInterval(updateDateAndTime, 1000);
        updateDateAndTime();
    </script>

    <script>
        function Sapa() {
            let currentDateTime = new Date();
            let currentHour = currentDateTime.getHours();
            let greetingElement = document.getElementById("hai");
            let greeting;

            if (currentHour >= 0 && currentHour < 6) {
                greeting = "Selamat malam";
            } else if (currentHour >= 6 && currentHour < 12) {
                greeting = "Selamat pagi";
            } else if (currentHour >= 12 && currentHour < 15) {
                greeting = "Selamat siang";
            } else if (currentHour >= 15 && currentHour < 18) {
                greeting = "Selamat sore";
            } else {
                greeting = "Selamat malam";
            }

            greetingElement.textContent = greeting;
        }
        Sapa();
    </script>

    <script src="{{ asset('/') }}backend/app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(function() {
            // Get context with jQuery - using jQuery's .get() method.
            let salesChartCanvas = $('#salesChart').get(0).getContext('2d');

            // Define the type of chart you want to create (Line, Bar, etc.)
            let salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: {
                    labels: {{ json_encode($data_tanggal) }},
                    datasets: [{
                        label: 'Pendapatan',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: 3,
                        pointBackgroundColor: '#3b8bba',
                        pointBorderColor: 'rgba(60,141,188,1)',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(60,141,188,1)',
                        data: {{ json_encode($data_pendapatan) }}
                    }]
                },
                options: {
                    scales: {
                        x: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tanggal'
                            }
                        }],
                        y: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Pendapatan'
                            }
                        }]
                    },
                    responsive: true
                }
            });
        });
    </script>
@endpush

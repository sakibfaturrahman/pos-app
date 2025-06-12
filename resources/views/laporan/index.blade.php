@extends('layouts.app')
@section('title')
    Daftar Pengeluaran
@endsection
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}backend/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-center">
                    <h4 class="card-title">
                        Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d
                        {{ tanggal_indonesia($tanggalAkhir, false) }}
                    </h4>
                </div>


                <form action="{{ route('laporan.index') }}" method="get" class="form-inline mb-2 mt-1">

                    <div class="form-group mr-2">
                        <span for="tanggal_awal" class="mr-2">Tanggal awal:</span>
                        <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control flatpickr-basic"
                            required autofocus value="{{ request('tanggal_awal') }}">
                    </div>

                    <div class="form-group mr-2">
                        <span for="tanggal_akhir" class="mr-2">Tanggal Sekarang:</span>
                        <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control flatpickr-basic"
                            required value="{{ request('tanggal_akhir') ?? date('Y-m-d') }}">
                    </div>

                    <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </form>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">
                        <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                            class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                <th>Pembelian</th>
                                <th>Pengeluaran</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/') }}backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
        <script src="{{ asset('/') }}backend/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
        <script>
            let table;

            $(function() {
                table = $('.table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    searching: false,
                    ajax: {
                        url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'tanggal'
                        },
                        {
                            data: 'penjualan'
                        },
                        {
                            data: 'pembelian'
                        },
                        {
                            data: 'pengeluaran'
                        },
                        {
                            data: 'pendapatan'
                        }
                    ],

                    bSort: false,
                    bPaginate: false,
                });

                // $('.datepicker').datepicker({
                //     format: 'yyyy-mm-dd',
                //     autoclose: true
                // });
            });

            function updatePeriode() {
                $('#modal-form').modal('show');
            }
        </script>
    @endpush
@endsection

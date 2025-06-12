@extends('layouts.app')

@section('title')
    Transaksi Pembelian
@endsection

@push('css')
    <style>
        .tampil-bayar {
            font-size: 3em;
            text-align: center;
            margin-top: 10px height: 100px;
            color: #f0f0f0;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        .table-pembelian tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom mb-1">
                    <table>
                        <tr>
                            <td>Supplier</td>
                            <td>: {{ $supplier->nama }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $supplier->telepon }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $supplier->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Kode Produk</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input type="hidden" name="pembelian_id" id="pembelian_id" value="{{ $pembelian_id }}">
                                    <input type="hidden" name="id" id="id">
                                    <div div class="input-group">
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk" />
                                        <div class="input-group-append" id="button-addon2">
                                            <button onclick="tampilModals()" type="button" class="btn btn-primary">
                                                <i data-feather='arrow-right'></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-pembelian">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
            <div class="card">
                <div class="col-lg-12">
                    <div class="tampil-bayar bg-primary"></div>
                    <div class="tampil-terbilang"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom mb-1">
                    <span class="card-title">
                        <h4> Transaksi Pembelian</h4>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('pembelian.store') }}" method="POST" class="form-pembelian">
                                @csrf
                                <input type="hidden" name="id" value="{{ $pembelian_id }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">

                                <div class="form-group row">
                                    <label for="totalrp" class="">Total Bayar</label>
                                    <div class="col-lg-12">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="">Diskon</label>
                                    <div class="col-lg-12">
                                        <input type="number" name="diskon" id="diskon" class="form-control"
                                            value="{{ $diskon }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="">Bayar</label>
                                    <div class="col-lg-12">
                                        <input type="text" id="bayarrp" class="form-control">
                                    </div>
                                </div>
                            </form>
                            <center><button type="submit" class="btn btn-primary btn-simpan">Simpan
                                    Transaksi</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@foreach ($produk as $item)
    <div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class=" table table-produk table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode Produk</th>
                                        <th>Nama</th>
                                        <th>harga beli</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_produk }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ format_uang($item->harga_beli) }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary"
                                                    onclick="pilihProduk('{{ $item->id }}', '{{ $item->kode_produk }}')">
                                                    <i class="fa fa-check-circle"></i>
                                                    Pilih
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- pesan --}}
<div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group ">
                            <center>
                                <strong>
                                    <p id="pesan-nya">P</p>
                                </strong>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let table, table2;
        //tampilkan data dengan dataTables
        $(document).ready(function() {
            table = $('.table-pembelian').DataTable({
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    autoWidth: false,
                    searching: false,
                    lengthChange: false,
                    info: false,
                    paging: false,
                    ajax: {
                        url: '{{ route('detail_pembelian.data', $pembelian_id) }}',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'nama_produk',
                            name: 'nama_produk'
                        },
                        {
                            data: 'harga_beli',
                            name: 'harga_beli'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'subtotal',
                            name: 'subtotal'
                        },
                        {
                            data: 'opsi',
                            name: 'opsi',
                            searchable: false,
                            sortable: false
                        }
                    ]
                })
                .on('draw.dt', function() {
                    loadForm($('#diskon').val());
                });

            //ubah jumlah dan total
            table2 = $('.table-produk').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('/detail_pembelian') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data Kesalahan: ' + errors.responseText);
                        return;
                    });
            });

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            });

            $('.btn-simpan').on('click', function() {
                $('.form-pembelian').submit();
            });
        });

        function tampilkanPesan(pesan) {
            document.getElementById('pesan-nya').textContent = pesan;
            $('#pesanModal').modal('show');
        }

        function tampilModals() {
            $('#modalProduk').modal('show');
        }

        function closeModals() {
            $('#modalProduk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id').val(id);
            $('#kode_produk').val(kode);
            closeModals();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('detail_pembelian.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        //hapuss
        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        '_token': $('[name=csrf-token]').attr('content'),
                    },
                    success: (response) => {
                        console.log(response);
                        table.ajax.reload();
                    },
                    error: (errors) => {
                        alert('Tidak dapat menghapus data. Kesalahan: ' + errors.responseText);
                    },
                });

            }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.totals').text());
            $('#total_item').val($('.total_items').text());

            $.get(`{{ url('/detail_pembelian/loadform') }}/${diskon}/${$('.totals').text()}`)

                .done(response => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);
                })
                .fail(errors => {
                    tampilkanPesan('Tidak dapat menampilkan data');
                    return;
                })
        }
    </script>
@endpush

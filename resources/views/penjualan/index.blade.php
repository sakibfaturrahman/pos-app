@extends('layouts.app')
@section('title')
    Daftar Penjualan
@endsection
@section('content')
    <section id="complex-header-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">
                            Data Penjualan
                        </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Tanggal</th>
                                    <th>Kode Member</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Diskon</th>
                                    <th>Total Bayar</th>
                                    <th>Kasir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ tanggal_indonesia($item->created_at, false) }}</td>
                                        <td>{{ $item->member->kode_member ?? '' }}</td>
                                        <td>{{ format_uang($item->total_item) }}</td>
                                        <td>{{ format_uang($item->total_harga) }}</td>
                                        <td>{{ $item->diskon }}%</td>
                                        <td>{{ format_uang($item->bayar) }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>

                                            {{-- <button onclick="showDetail('{{ route('penjualan.data', $item->id) }}')"
                                                class="btn btn-info"><i class="fa fa-eye"></i></button> --}}

                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#hapusProduk{{ $item->id }}">
                                                <i data-feather='trash-2'></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($penjualan as $item)
        <div class="modal fade" id="hapusProduk{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Penjualan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('penjualan.destroy', $item->id) }}" method="GET"
                            class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus riwayat penjualan ini?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('penjualan.detail')
@endsection

@push('scripts')
    <script>
        $(function() {
            table = $('.table-detail').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                ]
            })
        });

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        // function deleteData(url) {
        //     if (confirm('Yakin ingin menghapus data terpilih?')) {
        //         $.post(url, {
        //                 '_token': $('[name=csrf-token]').attr('content'),
        //                 '_method': 'get'
        //             })
        //             .done((response) => {
        //                 table.ajax.reload();
        //             })
        //             .fail((errors) => {
        //                 alert('Tidak dapat menghapus data');
        //                 return;
        //             });
        //     }
        // }
    </script>
@endpush

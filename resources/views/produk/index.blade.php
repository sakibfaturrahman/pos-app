@extends('layouts.app')
@section('title')
    Daftar Produk
@endsection
@section('content')
    <div class="container">
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Data Produk
                            <br><br>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#tambahProduk">
                                Tambah
                            </button>
                            {{-- <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')"
                                class="btn btn-sm btn-danger">Hapus</button> --}}
                            <button onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')"
                                class="btn btn-sm btn-info">Cetak
                                Barcode</button>
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <p>{{ $err }}</p>
                                @endforeach
                            @endif
                        </h4>
                    </div>
                    <div class="card-datatable">

                        <form action="" method="post" class="form-produk">
                            @csrf
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="select_all" id="select_all"></th>
                                        <th>NO</th>
                                        <th>Kode Produk</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Diskon</th>
                                        <th>Stok</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_produk }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->kategori->nama_kategori }}</td>
                                            <td>{{ $item->merk }}</td>
                                            <td>{{ format_uang($item->harga_beli) }}</td>
                                            <td>{{ format_uang($item->harga_jual) }}</td>
                                            <td>{{ $item->diskon }}%</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editProduk{{ $item->id }}">
                                                    <i data-feather='edit-3'></i>
                                                </button>
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
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- tambah --}}
    <div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produk.tambah') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_produk">Produk</label>
                                    <input type="text" id="nama_produk" class="form-control" name="nama_produk"
                                        placeholder="Nama Produk" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Kategori</label>
                                    <select name="kategori_id" id="kategori_id" class="form-control">
                                        <option value="" hidden>Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" id="merk" class="form-control" name="merk"
                                        placeholder="Merk" required />
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" id="harga_beli" class="form-control" name="harga_beli"
                                        placeholder="Harga Beli" required />
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" id="harga_jual" class="form-control" name="harga_jual"
                                        placeholder="Harga Jual" required />
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <input type="number" id="diskon" class="form-control" name="diskon" value="0"
                                        placeholder="Diskon" />
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" id="stok" class="form-control" name="stok"
                                        placeholder="Stok" required value="0" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- edit --}}
    @foreach ($produk as $item)
        <div class="modal fade" id="editProduk{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produk.edit', $item->id) }}" method="POST" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_produk">Produk</label>
                                        <input type="text" id="nama_produk" class="form-control" name="nama_produk"
                                            placeholder="Nama Produk" value="{{ $item->nama_produk }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_kategori">Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            <option value="" hidden>Pilih Kategori</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    @if ($k->id == $item->kategori_id) selected @endif>
                                                    {{ $k->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="merk">Merk</label>
                                        <input type="text" id="merk" class="form-control" name="merk"
                                            placeholder="Merk" value="{{ $item->merk }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="number" id="harga_beli" class="form-control" name="harga_beli"
                                            placeholder="Harga Beli" value="{{ $item->harga_beli }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="number" id="harga_jual" class="form-control" name="harga_jual"
                                            placeholder="Harga Jual" value="{{ $item->harga_jual }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon">Diskon</label>
                                        <input type="number" id="diskon" class="form-control" name="diskon"
                                            placeholder="Diskon" value="{{ $item->diskon }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" id="stok" class="form-control" name="stok"
                                            placeholder="Stok" value="{{ $item->stok }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- hapus --}}
    @foreach ($produk as $item)
        <div class="modal fade" id="hapusProduk{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produk.hapus', $item->id) }}" method="GET" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus <strong>{{ $item->nama_produk }}</strong> dari daftar
                                            Produk?
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

    {{-- confirm --}}
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm</h5>
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
                                        <p id="confirm-nya">P</p>
                                    </strong>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Oke</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- dt-complex-header --}}
@endsection
@push('scripts')
    <script>
        $('.table').DataTable();

        //select all
        $('[name=select_all]').on('click', function() {
            $(':checkbox').prop('checked', this.checked);
        });

        //tampilkan pesan
        function tampilkanPesan(pesan) {
            document.getElementById('pesan-nya').textContent = pesan;
            $('#pesanModal').modal('show');
        }
        //tampilkan pesan confirm
        function tampilkanConfirm(pesan) {
            document.getElementById('confirm-nya').textContent = pesan;
            $('#confirmModal').modal('show');
        }

        //hapus data yang dipilih
        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
                if (confirm('Yakin ingin menghapus data terpilih?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            tampilkanPesan('Produk berhasil dihapus!');
                            return;
                        })
                        .fail((errors) => {
                            tampilkanPesan('Tidak dapat menghapus data!');
                            return;
                        });
                }
            } else {
                tampilkanPesan('Pilih data lebih dari 1 di dihapus!');
                return;
            }
        }

        //cetak barcode

        // function cetakBarcode(url) {
        //     let jumlahChecked = $('input:checked').length;

        //     if (jumlahChecked < 3) {
        //         tampilkanPesan('Pilih minimal 3 data untuk dicetak!');
        //     } else {
        //         $('.form-produk')
        //             .attr('target', '_blank')
        //             .attr('action', url)
        //             .submit();
        //     }
        // }
        function cetakBarcode(url) {
            if ($('input:checked').length < 1) {
                tampilkanPesan('Pilih data yang akan dicetak!');
                return;
            } else if ($('input:checked').length < 3) {
                tampilkanPesan('Pilih minimal 3 data untuk dicetak!');
                return;
            } else {
                $('.form-produk')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }
    </script>
@endpush

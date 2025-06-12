@extends('layouts.app')
@section('title')
    Daftar Pengeluaran
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPengeluaran">
                            Tambah
                        </button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class=" table table-bordered">
                        <thead>
                            <tr>

                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $item)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ tanggal_indonesia($item->created_at, false) }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ format_uang($item->nominal) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editPengeluaran{{ $item->id }}">
                                            <i data-feather='edit-3'></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#hapusSupplier{{ $item->id }}">
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



    {{-- tambah --}}

    <div class="modal fade" id="tambahPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengeluaran.tambah') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_supplier">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama_supplier">Nominal</label>
                                    <input type="number" id="nominal" class="form-control" name="nominal"
                                        placeholder="Nominal" required />
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

    @foreach ($pengeluaran as $item)
        <div class="modal fade" id="editPengeluaran{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengeluaran.edit', $item->id) }}" method="POST" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_supplier">Nama</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" required>{{ $item->deskripsi }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_supplier">Nominal</label>
                                        <input type="number" id="nominal" class="form-control" name="nominal"
                                            placeholder="Nominal" value="{{ $item->nominal }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- hapus --}}
    @foreach ($pengeluaran as $item)
        <div class="modal fade" id="hapusPengeluaran{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengeluaran.hapus', $item->id) }}" method="POST"
                            class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus <strong>{{ $item->nama_kategori }}</strong>
                                            Pengeluaran ini?
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


    @push('scripts')
        <script>
            $('.table').DataTable();
        </script>
    @endpush

    {{-- dt-complex-header --}}
@endsection

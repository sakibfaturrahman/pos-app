@extends('layouts.app')
@section('title')
    Daftar Supplier
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSupplier">
                            Tambah
                        </button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class=" table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editSupplier{{ $item->id }}">
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

    <div class="modal fade" id="tambahSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.tambah') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_supplier">Nama</label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        placeholder="Nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_supplier">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat"
                                        placeholder="Alamat" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_supplier">Telepon</label>
                                    <input type="number" id="telepon" class="form-control" name="telepon"
                                        placeholder="No Telepon" required />
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

    @foreach ($supplier as $item)
        <div class="modal fade" id="editSupplier{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('supplier.edit', $item->id) }}" method="POST" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_member">Nama</label>
                                        <input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Nama" value="{{ $item->nama }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_member">Alamat</label>
                                        <input type="text" id="alamat" class="form-control" name="alamat"
                                            placeholder="Alamat" value="{{ $item->alamat }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_member">Telepon</label>
                                        <input type="number" id="telepon" class="form-control" name="telepon"
                                            placeholder="No Telepon" value="{{ $item->telepon }}" required />
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
    @foreach ($supplier as $item)
        <div class="modal fade" id="hapusSupplier{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('supplier.hapus', $item->id) }}" method="GET"
                            class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus <strong>{{ $item->nama_kategori }}</strong> dari daftar
                                            Supplier?
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

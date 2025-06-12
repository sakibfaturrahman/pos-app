@extends('layouts.app')
@section('title')
    Daftar User
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahUser">
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
                                <th>Role</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->role->role }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#hapusUser{{ $item->id }}">
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
    <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.tambah') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_user">Nama</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_user">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_user">Password</label>
                                    <input type="password" class="form-control form-control-merge" id="password"
                                        name="password" />
                                    <div class="input-group-append">
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_user">Password Confirm</label>
                                    <input type="password" class="form-control form-control-merge" id="password_confirm"
                                        name="password_confirm" />
                                    <div class="input-group-append">
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Registrasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    {{-- hapus --}}
    @foreach ($user as $item)
        <div class="modal fade" id="hapusUser{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.hapus', $item->id) }}" method="GET" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus <strong>{{ $item->nama_kategori }}</strong> dari daftar
                                            User?
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

@extends('layouts.app')
@section('title')
    Daftar Member
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahMember">
                            Tambah
                        </button>
                        <button onclick="cetakMember('{{ route('member.cetak_member') }}')" class="btn btn-info "> Cetak
                            Member</button>
                    </h4>
                </div>
                <div class="table-responsive">
                    <form action="" method="post" class="form-member">
                        @csrf
                        <table class=" table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" id="select_all"></th>
                                    <th>NO</th>
                                    <th>Kode Member</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $item)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_member }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editMember{{ $item->id }}">
                                                <i data-feather='edit-3'></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#hapusMember{{ $item->id }}">
                                                <i data-feather='trash-2'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>



    {{-- tambah --}}

    <div class="modal fade" id="tambahMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.tambah') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_member">Nama</label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        placeholder="Nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_member">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat"
                                        placeholder="Alamat" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama_member">Telepon</label>
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

    @foreach ($member as $item)
        <div class="modal fade" id="editMember{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('member.edit', $item->id) }}" method="POST" class="form form-vertical">
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
    @foreach ($member as $item)
        <div class="modal fade" id="hapusMember{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('member.hapus', $item->id) }}" method="GET" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                            Yakin Mau hapus <strong>{{ $item->nama }}</strong> dari daftar
                                            Member?
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
    @endforeach


    @push('scripts')
        <script>
            $('.table').DataTable();
            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });
        </script>
        <script>
            function tampilkanPesan(pesan) {
                document.getElementById('pesan-nya').textContent = pesan;
                $('#pesanModal').modal('show');
            }


            function cetakMember(url) {
                if ($('input:checked').length < 1) {
                    tampilkanPesan('Pilih data yang akan dicetak');
                    return;
                } else {
                    $('.form-member')
                        .attr('target', '_blank')
                        .attr('action', url)
                        .submit();
                }
            }
        </script>
    @endpush

    {{-- dt-complex-header --}}
@endsection

@extends('layouts.app')
@section('title')
    Settings
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                            aria-labelledby="account-pill-general" aria-expanded="true">
                            <h4>Profil Toko</h4>

                            <!-- form -->


                            @foreach ($setting as $item)
                                <form class="validate-form mt-2" action="{{ route('setting.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="account-username">Nama Toko</label>
                                                <input type="text" class="form-control" id="nama_perusahaan"
                                                    name="nama_perusahaan" placeholder="Username"
                                                    value="{{ $item->nama_perusahaan }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="account-name">Telepon</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon"
                                                    placeholder="Name" value="{{ $item->telepon }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="account-name">Diskon</label>
                                                <input type="text" class="form-control" id="diskon" name="diskon"
                                                    placeholder="Name" value="{{ $item->diskon }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="account-username">Tipe Nota</label>
                                                <select name="tipe_nota" class="form-control" id="tipe_nota" required>
                                                    <option value="1">Nota Kecil</option>
                                                    <option value="2">Nota Besar</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="account-name">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">{{ $item->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="account-name">Logo</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gambar_logo"
                                                        name="gambar_logo" />
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Simpan</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach

                            <!--/ form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <center>
                        <h6>Logo Toko</h6>
                    </center>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img id="file-ip-1-preview" width="300px" height="180">
                                {{-- <img src="{{ asset('storage/gambar/' . $buku->gambar) }}"alt="Card image cap"
                                        width="320px" height="450px"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0">
                    <center>
                        <h6>Card Member</h6>
                    </center>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <img id="file-ip-1-preview" width="300px" height="180">
                                {{-- <img src="{{ asset('storage/gambar/' . $buku->gambar) }}"alt="Card image cap"
                                        width="320px" height="450px"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

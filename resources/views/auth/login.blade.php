@extends('auth.main')
@section('title')
    Login
@endsection
@section('content')
    <div class="card mb-0">
        <div class="card-body">
            <a href="javascript:void(0);" class="brand-logo">
                {{-- {{ url($setting->gambar_logo) }} --}}
                <h2 class="brand-text text-primary ml-1">{{ $setting->nama_perusahaan }}</h2>
            </a>
            <center>
                <h4 class="card-title mb-1">Selamat Datang Kembali! 👋</h4>
                <p class="card-text">Silahkan login sebelum masuk ke Aplikasi!</p>
            </center>
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form class="auth-login-form mt-2" action="{{ route('login.action') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login-email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" />
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="login-password">Password</label>
                        {{-- <a href="{{ url('password') }}">
                            <small>Forgot Password?</small>
                        </a> --}}
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" class="form-control form-control-merge" id="password" name="password" />
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="remember-me" tabindex="3" />
                        <label class="custom-control-label" for="remember-me"> Remember Me </label>
                    </div>
                </div> --}}
                <button class="btn btn-primary btn-block" type="submit" tabindex="4">Sign in</button>
            </form>

            {{-- <p class="text-center mt-2">
                <span>New on our platform?</span>
                <a href="page-auth-register-v1.html">
                    <span>Create an account</span>
                </a>
            </p>

            <div class="divider my-2">
                <div class="divider-text">or</div>
            </div>

            <div class="auth-footer-btn d-flex justify-content-center">
                <a href="javascript:void(0)" class="btn btn-facebook">
                    <i data-feather="facebook"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-twitter white">
                    <i data-feather="twitter"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-google">
                    <i data-feather="mail"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-github">
                    <i data-feather="github"></i>
                </a>
            </div> --}}
        </div>
    </div>
@endsection

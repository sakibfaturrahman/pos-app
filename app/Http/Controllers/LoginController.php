<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_action(Request $request)
    {
        //validasi login
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        //jika uname/pw salah
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            Alert::success('Selamat datang kembali!');
            return redirect()->intended('/')->with('success');
        } else {
            return back()->withErrors([
                'password' => 'Username Atau Password yang anda masukan salah!',
            ]);
        }


        // // cek jika admin
        // if (Auth::user()->role_id == 1) {

        //     Alert::success('Selamat datang kembali!');
        //     return redirect()->intended('/')->with('success');
        // }

        // //cek jika user
        // if (Auth::user()->role_id == 2) {

        //     Alert::success('Login Success');
        //     return redirect()->intended('/')->with('success');
        // }
        // dd(Auth::user());

        //salah hehe tadinya mau beda page tapi setelah dipikir kembali lebih simple pengecekan di dashboard
    }

    public function password()
    {
        return view('auth.password');
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Berhasil Diubah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}

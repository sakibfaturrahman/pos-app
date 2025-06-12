<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'user' => User::where('role_id', 2)->get(),
        ];
        return view('user.index', $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        Alert::success('Berhasil Menambahkan kasir baru!');
        return redirect()->back();
    }

    public function profil()
    {
        $data = [
            'user' => User::where('role_id', 2)->get(),
        ];
        return view('user.profil',);
    }

    public function update($id, Request $request)
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

    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id)->delete();
        Alert::toast('Berhasil mengahapus user!', 'success');
        return redirect()->back();
    }
}

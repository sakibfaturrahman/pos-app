<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function index()
    {
        $data = [
            'setting' => Setting::all()
        ];
        return view('setting.index', $data);
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->nama_perusahaan = $request->nama_perusahaan;
        $setting->telepon = $request->telepon;
        $setting->alamat = $request->alamat;
        $setting->diskon = $request->diskon;
        $setting->tipe_nota = $request->tipe_nota;

        // $newName = '';
        // if ($request->file('gambar')) {
        //     $extension = $request->file('gambar')->getClientOriginalExtension();
        //     $newName = $request->gambar_logo . '.' . $extension;

        //     $request->file('gambar')->storeAs('public/gambar', $newName);
        // }

        // $payload = $request->except('gambar');
        // $payload['gambar'] = $newName;

        if ($request->hasFile('gambar_logo')) {
            $file = $request->file('gambar_logo');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar', $nama);

            $setting->gambar_logo = "public/gambar/$nama";
        }

        // dd($setting);
        $setting->update();


        Alert::toast('Toko Diperbarui', 'success');
        return redirect()->back();
    }
}

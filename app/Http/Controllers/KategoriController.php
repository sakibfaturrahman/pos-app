<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::create($request->all());
        Alert::toast('Berhasil Menambahkan Kategori baru!', 'success');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id)->update($request->all());
        Alert::toast('Berhasil mengupdate Kategori ini!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $kategori = Kategori::FindOrFail($id)->delete();
        Alert::toast('Berhasil mengahapus Kategori!', 'success');
        return redirect()->back();
    }
}

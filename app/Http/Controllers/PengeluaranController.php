<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::all();

        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required',
        ]);
        $pengeluaran = Pengeluaran::create($request->all());
        Alert::toast('Berhasil Menambahkan pengeluaran', 'success');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id)->update($request->all());
        Alert::toast('Berhasil mengupdate pengeluaran ini!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $pengeluaran = Pengeluaran::findOrFail($id)->delete();
        Alert::toast('Berhasil mengahapus pengeluaran!', 'success');
        return redirect()->back();
    }
}

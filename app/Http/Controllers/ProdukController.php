<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'produk' => Produk::all(),
            'kategori' => Kategori::all(),
        ];
        return view('produk.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'diskon' => 'required',
            'stok' => 'required',

        ], [
            'nama_produk.required' => 'Produk wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'merk.required' => 'Merk produk wajib diisi',
            'harga_beli.required' => 'Harga Beli wajib diisi',
            'harga_jual.required' => 'Tentukan Harga jual!',
            'diskon.required' => 'Masukan diskon!',
            'stok.required' => 'Produk wajib diisi',
        ]);

        $produk = Produk::latest()->first() ?? new Produk();
        $request['kode_produk'] = 'SPX' . tambah_nol_didepan((int)$produk->id + 1, 7);
        $produk = Produk::create($request->all());
        Alert::toast('Produk Berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'diskon' => 'required',
            'stok' => 'required',

        ], [
            'nama_produk.required' => 'Produk wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'merk.required' => 'Merk produk wajib diisi',
            'harga_beli.required' => 'Harga Beli wajib diisi',
            'harga_jual.required' => 'Tentukan Harga jual!',
            'stok.required' => 'Produk wajib diisi',
        ]);


        $produk = Produk::findOrFail($id)->update($request->all());
        Alert::toast('Produk Berhasil diupdate', 'success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id)->delete();
        Alert::toast('Berhasil menghapus produk', 'success');
        return redirect()->back();
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }
        Alert::toast('Berhasil menghapus produk', 'success');
        return redirect()->back();
    }

    //cetak barcode sesuai request di ajax
    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $no  = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }
}

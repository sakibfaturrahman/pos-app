<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    public function index()
    {
        $data = [
            'pembelian' => Pembelian::all(),
            'supplier' => Supplier::all(),

        ];
        return view('pembelian.index', $data);
    }

    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->supplier_id = $id;
        $pembelian->total_item  = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon      = 0;
        $pembelian->bayar       = 0;
        $pembelian->save();

        session(['pembelian_id' => $pembelian->id]);
        session(['supplier_id' => $pembelian->supplier_id]);

        return redirect()->route('detail_pembelian.index');
    }

    public function store(Request $request)
    {
        $pembelian = Pembelian::findOrFail($request->id);
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->save();

        $detail = PembelianDetail::where('pembelian_id', $pembelian->id)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->produk_id);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        Alert::toast('Berhasil melakukan pembelian', 'success');
        return redirect()->route('pembelian.index');
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $detail    = PembelianDetail::where('pembelian_id', $pembelian->id)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->produk_id);
            if ($produk) {
                $produk->stok -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $pembelian->delete();

        Alert::toast('Berhasil menghapus pembelian', 'success');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Setting;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Barryvdh\DomPDF\Facade\PdF;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = [
            'penjualan' => Penjualan::with('member')->orderBy('id', 'desc')->get(),
        ];
        return view('penjualan.index', $data);
    }

    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->member_id = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['penjualan_id' => $penjualan->id]);
        return redirect()->route('detail_transaksi.index');
    }

    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->penjualan_id);
        $penjualan->member_id = $request->member_id;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = PenjualanDetail::where('penjualan_id', $penjualan->id)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->produk_id);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        Alert::toast('Transaksi telah berhasil', 'success');
        return redirect()->route('detail_transaksi.selesai');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $detail    = PenjualanDetail::where('penjualan_id', $penjualan->id)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->produk_id);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $penjualan->delete();

        Alert::toast('Riwayat penjualan dihapus', 'success');
        return redirect()->back();
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('penjualan.selesai', compact('setting'));
    }

    public function strukKecil()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('penjualan_id'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('penjualan_id', session('penjualan_id'))
            ->get();

        return view('penjualan.strukkecil', compact('setting', 'penjualan', 'detail'));
    }

    public function strukBesar()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('penjualan_id'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('penjualan_id', session('penjualan_id'))
            ->get();

        $pdf = PDF::loadView('penjualan.strukbesar', compact('setting', 'penjualan', 'detail'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');
        return $pdf->stream('Transaksi-' . date('Y-m-d-his') . '.pdf');
    }


    //detail data
    public function show($id)
    {
        $detail = PenjualanDetail::with('produk')->where('penjualan_id', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">' . $detail->produk->kode_produk . '</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. ' . format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }
}

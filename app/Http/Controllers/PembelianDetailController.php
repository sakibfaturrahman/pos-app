<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $pembelian_id = session('pembelian_id');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('supplier_id'));
        $diskon = Pembelian::find($pembelian_id)->diskon ?? 0;

        // return session('pembelian_id');
        if (!$supplier) {
            abort(404);
        }

        return view('pembeliandetail.index', compact('pembelian_id', 'produk', 'supplier', 'diskon'));
    }


    // tampilkan dengan datatables
    public function data($id)
    {
        $detail = PembelianDetail::with('produk')->where('pembelian_id', $id)->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['nama_produk'] = $item->produk->nama_produk;
            $row['harga_beli']  = 'Rp. ' . format_uang($item->harga_beli);
            $row['jumlah']      = '<input type="number" class="form-control form-control-sm quantity" data-id="' . $item->id . '" value="' . $item->jumlah . '">';


            $row['subtotal']    = 'Rp. ' . format_uang($item->subtotal);
            $row['opsi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('detail_pembelian.destroy', $item->id) . '`)" class="btn btn-danger">Hapus</button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'nama_produk' => '
                <div class="totals hide">' . $total . '</div>
                <div class="total_items hide">' . $total_item . '</div>',
            'harga_beli'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'opsi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['opsi', 'nama_produk', 'jumlah'])
            ->make(true);
    }


    public function store(Request $request)
    {
        $produk = Produk::where('id', $request->id)->first();

        if (!$produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PembelianDetail();
        $detail->pembelian_id = $request->pembelian_id;
        $detail->produk_id = $produk->id;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();


        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PembelianDetail::findOrFail($id)->delete();

        return response(null, 204);
    }

    //load form pembelian
    public function loadForm($diskon, $total)
    {

        $bayar = $total - ($diskon / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar) . ' Rupiah')
        ];

        return response()->json($data);
    }
}

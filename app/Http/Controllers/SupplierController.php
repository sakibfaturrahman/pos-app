<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();

        return view('supplier.index', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $supplier = Supplier::create($request->all());
        Alert::toast('Berhasil Menambahkan supplier baru!', 'success');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id)->update($request->all());
        Alert::toast('Berhasil mengupdate supplier ini!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id)->delete();
        Alert::toast('Berhasil mengahapus supplier!', 'success');
        return redirect()->back();
    }
}

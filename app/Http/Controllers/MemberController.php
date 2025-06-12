<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::all();

        return view('member.index', compact('member'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $member = Member::latest()->first() ?? new Member();
        $request['kode_member'] = 'BMSF' . tambah_nol_didepan((int)$member->id + 1, 5);
        $member = Member::create($request->all());
        Alert::toast('Berhasil Menambahkan member baru!', 'success');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $member = Member::findOrFail($id)->update($request->all());
        Alert::toast('Berhasil mengupdate member ini!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $member = Member::FindOrFail($id)->delete();
        Alert::toast('Berhasil mengahapus member!', 'success');
        return redirect()->back();
    }

    public function cetakMember(Request $request)
    {
        $datamember = collect(array());
        foreach ($request->id as $id) {
            $member = Member::find($id);
            $datamember[] = $member;
        }

        $datamember = $datamember->chunk(2);
        $setting    = Setting::first();

        $no  = 1;
        $pdf = PDF::loadView('member.cetak', compact('datamember', 'no', 'setting'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}

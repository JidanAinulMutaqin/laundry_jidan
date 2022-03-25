<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\PenjemputanExport;
use App\Imports\PenjemputanImport;
use Maatwebsite\Excel\Facades\Excel;

class PenjemputanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['penjemputan'] = Penjemputan::all();
        $member['member'] = Member::all();
        return view('penjemputan.index', $data, $member);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_member' => 'required',
            'petugas' => 'required',
            'status' => 'required'
        ]);

        Penjemputan::create($validate);

        return redirect(request()->segment(1).'/penjemputan')->with('success', 'New Data has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjemputan $penjemputan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjemputan $penjemputan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjemputan $penjemputan)
    {
        $validatedData = $request->validate([
            'id_member' => 'required',
            'petugas' => 'required',
            'status' => 'required'
        ]);

        Penjemputan::where('id', $penjemputan->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/penjemputan')->with('success', 'New Data has been added!');
    }

    public function status(request $request)
    {
        $data = Penjemputan::where('id', $request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data Gagal Ditarik';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Penjemputan::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/penjemputan');
    }

    public function exportPenjemputan()
    {
        return Excel::download(new PenjemputanExport, 'penjemputan.xlsx');
    }

    public function importPenjemputan(Request $request) {
        $request->validate([
            'file2' => 'file|required|mimes:xlsx',
        ]);

        if ($request) {
            Excel::import(new PenjemputanImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => 'file belum terisi',
            ]);
        }

        return redirect(request()->segment(1).'/penjemputan')->with('success', 'Data berhasil diimport!');
        // return redirect()->route('paket.index')->with('success', 'Data berhasil diimport!');
    }

}

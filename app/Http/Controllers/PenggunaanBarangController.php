<?php

namespace App\Http\Controllers;

use App\Models\PenggunaanBarang;
use App\Exports\PenggunaanBarangExport;
use App\Imports\PenggunaanBarangImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PenggunaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PenggunaanBarang.index', [
            'penggunaan_barang' => PenggunaanBarang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('PenggunaanBarang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status' => 'required'
        ]);

        PenggunaanBarang::create($validatedData);

        return redirect(request()->segment(1).'/PenggunaanBarang')->with('success', 'New Data has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PenggunaanBarang $penggunaan_barang)
    {
        return view('PenggunaanBarang.edit',[
            'penggunaan_barang' => $penggunaan_barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenggunaanBarang $pg, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status' => 'required'
        ]);
        $pg = PenggunaanBarang::find($id);

        PenggunaanBarang::where('id', $pg->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/PenggunaanBarang')->with('success', 'Data has been edited!');
    }

    public function status(request $request)
    {
        $data = PenggunaanBarang::where('id', $request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data Gagal Ditarik';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = PenggunaanBarang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/PenggunaanBarang');
    }

    public function exportPenggunaanBarang()
    {
        return Excel::download(new PenggunaanBarangExport, 'outlet.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index',[
            'member' => member::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required'
        ]);

        Member::create($validatedData);

        return redirect(request()->segment(1).'/member')->with('success', 'New Data has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('member.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required'
        ]);

        Member::where('id', $member->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/member')->with('success', 'New Data has been added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Member::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/member');
    }

    public function exportMember()
    {
        return Excel::download(new MemberExport, 'member.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'fileMember' => 'file|required|mimes:xlsx',
        ]);

        if ($request) {
            Excel::import(new MemberImport, $request->file('fileMember'));
        } else {
            return back()->withErrors([
                'fileMember' => 'file belum terisi',
            ]);
        }

        return redirect(request()->segment(1).'/member')->with('success', 'Data berhasil diimport!');
    }
}

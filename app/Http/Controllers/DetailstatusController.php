<?php

namespace App\Http\Controllers;

use App\Models\status;
use App\Models\detailstatus;
use App\Http\Requests\StoredetailstatusRequest;
use App\Http\Requests\UpdatedetailstatusRequest;
use App\Models\Regency;

class DetailstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.status.instansi.index',[
            'instansi'=>detailstatus::all(),
            'status'=>status::all(),
            'kota'=>Regency::all()->sortBy('name')
        ]);
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
     * @param  \App\Http\Requests\StoredetailstatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredetailstatusRequest $request)
    {
        $validins=$request->validate([
            'id_status'=>'required',
            'nama'=>'required|unique:detailstatuses',
            'singkatan'=>'required|unique:detailstatuses|alpha|min:2|max:8',
            'tempat'=>'required',
        ]);
        $setor=detailstatus::create($validins);
        if($setor){
            return redirect(route('instansi.index'))->with('success','Data Berhasil Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detailstatus  $detailstatus
     * @return \Illuminate\Http\Response
     */
    public function show(detailstatus $detailstatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detailstatus  $detailstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(detailstatus $detailstatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedetailstatusRequest  $request
     * @param  \App\Models\detailstatus  $detailstatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedetailstatusRequest $request, detailstatus $detailstatus)
    {
        $validup=$request->validate([
            'id_status'=>'required',
            'nama'=>'required|unique:detailstatuses',
            'singkatan'=>'required|unique:detailstatuses|alpha|min:2|max:8',
            'tempat'=>'required',  
        ]);
        if($request->nama!=$detailstatus->nama){
            $validup['nama']='required|unique:detailstatuses';
        }
        if($request->singkatan!=$detailstatus->singkatan){
            $validup['singkatan']='required|unique:detailstatuses|alpha|min:2|max:8';
        }
        $up=detailstatus::where('id',$detailstatus->id)->update($validup);

        if ($up) {
            return redirect(route('instansi.index'))->with('success','Data Berhasil Di Update');
        } else {
            return redirect(route('instansi.index'))->with('error','Gagal Update Data');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detailstatus  $detailstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=detailstatus::where('id',$id)->get();
        detailstatus::destroy($delete);
        return redirect(route('instansi.index'))->with('success','Data Berhasil Dihapus');
    }
}

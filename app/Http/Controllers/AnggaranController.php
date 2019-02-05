<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Golongan;
use App\Unitkerja;
use App\Pegawai;
use Validator;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Anggaran;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $DataUnitkerja = DB::table('unitkerja')
                        -> where('eselon','=','3')->get();
        $DataAnggaran = DB::table('anggaran')
                        -> leftJoin('unitkerja','anggaran.unitkerja','=','unitkerja.kode')
                        -> select(DB::Raw('anggaran.*,unitkerja.id as unit_id, unitkerja.kode as unit_kode,unitkerja.nama as unit_nama'))
                        -> get();
        return view('anggaran.index',compact('DataAnggaran','DataUnitkerja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $DataUnitkerja = DB::table('unitkerja')
                        -> where('eselon','=','3')->get();
        return view('anggaran.form',compact('DataUnitkerja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Anggaran::create($request->all());

        //alert()->success('Berhasil.','Data telah ditambahkan!');
        Session::flash('message', 'Data telah ditambahkan');
        Session::flash('message_type', 'success');
        return back();
        //return redirect()->route('anggaran.index');
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
    public function edit($id)
    {
        //
        $DataUnitkerja = DB::table('unitkerja')
                        -> where('eselon','=','3')->get();
        $DataAnggaran = Anggaran::findOrFail($id);
        return view('anggaran.editform',compact('DataAnggaran','DataUnitkerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       $dataAnggaran = Anggaran::findOrFail($request->anggaran_id);
       $dataAnggaran -> update($request->all());
       //alert()->success('Berhasil.','Data telah ditambahkan!');
       Session::flash('message', 'Data telah diupdate');
       Session::flash('message_type', 'success');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
       $dataAnggaran = Anggaran::findOrFail($request->anggaran_id);
       $dataAnggaran -> delete();
       
       Session::flash('message', 'Data telah di delete');
       Session::flash('message_type', 'danger');
       return back();
    }
}
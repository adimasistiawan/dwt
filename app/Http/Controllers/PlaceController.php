<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tempat.index');
    }

    public function data(Request $request){
        $data = Place::where('is_delete',0)->orderBy('created_at','desc');
        return DataTables::of($data)
        ->addIndexColumn()
        
        ->addColumn('action', function($row){
         
            $btn = '<div class="btn btn-danger btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
            <i class="fa fa-trash"></i>
            Hapus
        </div> &nbsp;';
            $btn .= '<div class="btn btn-warning btn-sm edit mr-2 waves-effect" data-id="'.$row->id.'"  data-toggle="modal"><i class="fa fa-edit"></i> Ubah</div>';
            return $btn;
        })
       
        ->rawColumns(['action'])
        ->make(true);
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
        if(!$request->id){
            $check = Place::where('kode_invoice', $request->kode_invoice)->count();
            if($check > 0){
                return redirect()->back()->with('error','Kode invoice sudah dipakai di tempat lain, silahkan pakai kode lain');
            }
            $data = new Place();
            $data->nama = $request->nama;
            $data->kode_invoice = $request->kode_invoice;
            $data->save();
        }else{
            $data = Place::find($request->id);
            $check = Place::where('kode_invoice', $request->kode_invoice)->where('kode_invoice', '!=', $data->kode_invoice)->count();
            if($check > 0){
                return redirect()->back()->with('error','Kode invoice sudah dipakai di tempat lain, silahkan pakai kode lain');
            }
            $data->nama = $request->nama;
            $data->kode_invoice = $request->kode_invoice;
            $data->save();
        }

        return redirect()->back()->with('success','Berhasil');
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
        $data = Place::find($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Place::find($id);
        $data->is_delete = 1;
        $data->save();
        Session::flash('success', 'Berhasil'); 
        return 1;
    }
}

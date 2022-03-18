<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jenisproduk.index');
    }

    public function data(Request $request){
        $data = JenisProduk::orderBy('created_at','desc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('is_delete', function($row){
            if($row->is_delete == 0){
                return "<span class='badge bg-success'>Aktif</span>";
            }else{
                return "<span class='badge bg-danger'>Non Aktif</span>";
            }
        })
        ->addColumn('action', function($row){
            if($row->is_delete == 0){
                $btn = '<div class="btn btn-danger btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
                Non Aktifkan
            </div> &nbsp;';
            }else{
                $btn = '<div class="btn btn-success btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
                Aktifkan
            </div> &nbsp;';
            }
            $btn .= '<div class="btn btn-warning btn-sm edit mr-2 waves-effect" data-id="'.$row->id.'"  data-toggle="modal"><i class="fa fa-edit"></i> Ubah</div>';
            return $btn;
        })
       
        ->rawColumns(['action','is_delete'])
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
          
            $data = new JenisProduk();
            $data->nama = $request->nama;
            $data->save();
        }else{
            $data = JenisProduk::find($request->id);
            $data->nama = $request->nama;
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
        $data = JenisProduk::find($id);
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
        $data = JenisProduk::find($id);
        $data->is_delete = $data->is_delete == 1?0:1;
        $data->save();
        Session::flash('success', 'Berhasil'); 
        return 1;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Str;
use Image;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_usaha = JenisUsaha::where('is_delete',0)->get();
        return view('tempat.index',compact('jenis_usaha'));
    }

    public function data(Request $request){
        $data = Place::orderBy('created_at','asc');
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
            $check = Place::where('kode_invoice', $request->kode_invoice)->count();
            if($check > 0){
                return redirect()->back()->with('error','Kode invoice sudah dipakai di tempat lain, silahkan pakai kode lain');
            }
            $data = new Place();
            $data->nama = $request->nama;
            $data->jenis_usaha = $request->jenis_usaha;
            $data->kode_invoice = $request->kode_invoice;
            if($request->file('logo')){
                $file = $request->file('logo');
                $name   = Str::random(20).".".$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(200, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(\base_path() ."/public/logo/".$name);
                $data->logo = $name;
            }
            $data->save();
        }else{
            $data = Place::find($request->id);
            $check = Place::where('kode_invoice', $request->kode_invoice)->where('kode_invoice', '!=', $data->kode_invoice)->count();
            if($check > 0){
                return redirect()->back()->with('error','Kode invoice sudah dipakai di tempat lain, silahkan pakai kode lain');
            }
            $data->nama = $request->nama;
            $data->jenis_usaha = $request->jenis_usaha;
            $data->kode_invoice = $request->kode_invoice;
            if($request->file('logo')){

                $image_path = 'logo/'.$data->logo;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $file = $request->file('logo');
                $name   = Str::random(20).".".$file->getClientOriginalExtension();
                $img = Image::make($file);
                $img->resize(200, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(\base_path() ."/public/logo/".$name);
                $data->logo = $name;
            }
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
        $data->is_delete =  $data->is_delete == 1?0:1;
        $data->save();
        Session::flash('success', 'Berhasil'); 
        return 1;
    }
}

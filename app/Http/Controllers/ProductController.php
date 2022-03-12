<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat_wisata = Place::where('is_delete',0)->get();
        return view('produk.index',compact('tempat_wisata'));
    }

    public function data(Request $request){
        $data = Product::where('is_delete',0)->orderBy('created_at','desc')->with('place');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tempat', function($row){
            return $row->place->nama;
        })
        ->editColumn('harga', function($row){
            return number_format($row->harga , 0, ',', '.');
        })
        ->editColumn('komisi', function($row){
            return $row->komisi."%";
        })
        ->addColumn('action', function($row){
         
            $btn = '<div class="btn btn-danger btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
            <i class="fa fa-trash"></i> Hapus
        </div> &nbsp;';
            $btn .= '<div class="btn btn-warning btn-sm edit mr-2 waves-effect" data-id="'.$row->id.'"  data-toggle="modal"><i class="fa fa-edit"></i> Ubah</div>';
            return $btn;
        })
       
        ->rawColumns(['action','tempat'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            $data = new Product();
            $data->nama = $request->nama;
            $data->jenis = $request->jenis;
            $data->harga = $request->harga;
            $data->komisi = $request->komisi;
            $data->place_id = $request->place_id;
            $data->save();
        }else{
            $data = Product::find($request->id);
            $data->nama = $request->nama;
            $data->jenis = $request->jenis;
            $data->harga = $request->harga;
            $data->komisi = $request->komisi;
            $data->place_id = $request->place_id;
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
        $data = Product::find($id);
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
        $data = Product::find($id);
        $data->is_delete = 1;
        $data->save();
        Session::flash('success', 'Berhasil'); 
        return 1;
    }
}

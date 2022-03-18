<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
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
        $jenis_produk = JenisProduk::where('is_delete',0)->get();
        return view('produk.index',compact('tempat_wisata','jenis_produk'));
    }

    public function data(Request $request){
        $data = Product::orderBy('created_at','desc')->with('place');
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
        ->filter(function ($instance) use ($request) {
       
            if ($request->get('place_id')) {
                $instance->where('place_id', $request->get('place_id'));
            }
            if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                   $search = $request->get('search');
                   $w->orWhere('nama', 'LIKE', "%$search%")
                   ->orWhereHas('place', function($q) use($search){
                     $q->where('nama', 'LIKE', "%$search%");
                   })
                  ->orWhere('harga', 'LIKE', "%$search%")
                  ->orWhere('komisi', 'LIKE', "%$search%");
               });
            }
        })
       
        ->rawColumns(['action','tempat','is_delete'])
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
        $data->is_delete =  $data->is_delete == 1?0:1;
        $data->save();
        Session::flash('success', 'Berhasil'); 
        return 1;
    }
}

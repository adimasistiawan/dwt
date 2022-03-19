<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Place;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Place::where('is_delete',0)->orderBy('nama','desc')->get();
        if(Auth::user()->role != 3){
            $check = Penjualan::where('status',0)->count();
            if($check > 0){
                $btn = 1;
            }else{
                $btn = 0;
            }
        }else{
            $btn = 0;
        }
        return view('penjualan.index', compact('place', 'btn'));
    }

    public function data(Request $request){
        if(Auth::user()->role == 3){
            $data = Penjualan::where('place_id', Auth::user()->place_id)->orderBy('created_at','desc')->with('place');
        }else{
            $data = Penjualan::orderBy('created_at','desc')->with('place');
        }
    
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tempat', function($row){
            return $row->place->nama;
        })
        ->editColumn('total', function($row){
            return number_format($row->total , 0, ',', '.');
        })
        ->editColumn('tanggal', function($row){
            return date('d-m-Y', strtotime($row->tanggal));
        })
        ->editColumn('status', function($row){
            if($row->status == 1){
                return "<span class='badge bg-success'>Sudah Dibayar</span>";
            }else{
                return "<span class='badge bg-danger'>Belum Dibayar</span>";
            }
        })
        // ->editColumn('kode', function($row){
        //     return $row->place->kode_invoice.$row->kode;
        // })
        ->addColumn('action', function($row){
            if(Auth::user()->role == 3){
             
                $btn = '<a href="'.route('penjualan.show', $row->id).'" class="btn btn-success btn-sm mr-2 waves-effect"><i class="fa fa-search"></i> Lihat</a> &nbsp;';
          
            }else{
                $btn = '<a href="'.route('penjualan.show', $row->id).'" class="btn btn-success btn-sm mr-2 waves-effect"><i class="fa fa-search"></i> Lihat</a> &nbsp;';
                if($row->status == 0){
                    $btn .= '<div class="btn btn-info btn-sm mr-2 btn-change-status waves-effect"  data-id="'.$row->id.'"><i class="fa fa-check"></i> Sudah Dibayar</div> &nbsp;';
                }
            }
        
            return $btn;
        })

        ->filter(function ($instance) use ($request) {
            if ($request->get('dari') && $request->get('sampai')) {
                $instance->whereDate('tanggal', '>=', $request->get('dari'))->whereDate('tanggal', '<=', $request->get('sampai'));
            }
            if ($request->get('tempat_wisata')) {
                $instance->where('place_id', $request->get('tempat_wisata'));
            }
            if ($request->get('status')) {
                $instance->where('status', $request->get('status'));
            }
            if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                   $search = $request->get('search');
                   $w->orWhere('kode', 'LIKE', "%$search%")
                   ->orWhereHas('place', function($q) use($search){
                     $q->where('nama', 'LIKE', "%$search%");
                   })
                  ->orWhere('total', 'LIKE', "%$search%");
               });
            }
        })
       
        ->rawColumns(['action','tempat','status'])
        ->make(true);
    }

    public function penjualan_belum_bayar()
    {
        $place = Place::where('is_delete',0)->orderBy('nama','desc')->get();
        $check = Penjualan::where('status',0)->count();
        if($check > 0){
            $btn = 1;
        }else{
            $btn = 0;
        }
        return view('penjualan.belumbayar', compact('place', 'btn'));
    }

    public function penjualan_belum_bayar_data(Request $request){
        $data = Penjualan::where('status',0)->orderBy('created_at','desc')->with('place');
    
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tempat', function($row){
            return $row->place->nama;
        })
        ->editColumn('total', function($row){
            return number_format($row->total , 0, ',', '.');
        })
        ->editColumn('tanggal', function($row){
            return date('d-m-Y', strtotime($row->tanggal));
        })
        ->editColumn('status', function($row){
            if($row->status == 1){
                return "<span class='badge bg-success'>Sudah Dibayar</span>";
            }else{
                return "<span class='badge bg-danger'>Belum Dibayar</span>";
            }
        })
        // ->editColumn('kode', function($row){
        //     return $row->place->kode_invoice.$row->kode;
        // })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('penjualan.show', $row->id).'" class="btn btn-success btn-sm mr-2 waves-effect"><i class="fa fa-search"></i> Lihat</a> &nbsp;';
            if($row->status == 0){
                $btn .= '<div class="btn btn-info btn-sm mr-2 btn-change-status waves-effect"  data-id="'.$row->id.'"><i class="fa fa-check"></i> Sudah Dibayar</div> &nbsp;';
            }
        
            return $btn;
        })

        ->filter(function ($instance) use ($request) {
            if ($request->get('dari') && $request->get('sampai')) {
                $instance->whereDate('tanggal', '>=', $request->get('dari'))->whereDate('tanggal', '<=', $request->get('sampai'));
            }
            if ($request->get('tempat_wisata')) {
                $instance->where('place_id', $request->get('tempat_wisata'));
            }
            if ($request->get('status')) {
                $instance->where('status', $request->get('status'));
            }
            if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                   $search = $request->get('search');
                   $w->orWhere('kode', 'LIKE', "%$search%")
                   ->orWhereHas('place', function($q) use($search){
                     $q->where('nama', 'LIKE', "%$search%");
                   })
                  ->orWhere('total', 'LIKE', "%$search%");
               });
            }
        })
       
        ->rawColumns(['action','tempat','status'])
        ->make(true);
    }

    public function penjualan_sudah_bayar()
    {
        $place = Place::where('is_delete',0)->orderBy('nama','desc')->get();
        return view('penjualan.sudahbayar', compact('place'));
    }

    public function penjualan_sudah_bayar_data(Request $request){
        $data = Penjualan::where('status',1)->orderBy('tanggal_bayar','desc')->with('place');
    
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tempat', function($row){
            return $row->place->nama;
        })
        ->editColumn('total', function($row){
            return number_format($row->total , 0, ',', '.');
        })
        ->editColumn('tanggal', function($row){
            return date('d-m-Y', strtotime($row->tanggal));
        })
        ->editColumn('status', function($row){
            if($row->status == 1){
                return "<span class='badge bg-success'>Sudah Dibayar</span>";
            }else{
                return "<span class='badge bg-danger'>Belum Dibayar</span>";
            }
        })
        // ->editColumn('kode', function($row){
        //     return $row->place->kode_invoice.$row->kode;
        // })
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('penjualan.show', $row->id).'" class="btn btn-success btn-sm mr-2 waves-effect"><i class="fa fa-search"></i> Lihat</a> &nbsp;';
        
            return $btn;
        })

        ->filter(function ($instance) use ($request) {
            if ($request->get('dari') && $request->get('sampai')) {
                $instance->whereDate('tanggal', '>=', $request->get('dari'))->whereDate('tanggal', '<=', $request->get('sampai'));
            }
            if ($request->get('tempat_wisata')) {
                $instance->where('place_id', $request->get('tempat_wisata'));
            }
            if ($request->get('status')) {
                $instance->where('status', $request->get('status'));
            }
            if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                   $search = $request->get('search');
                   $w->orWhere('kode', 'LIKE', "%$search%")
                   ->orWhereHas('place', function($q) use($search){
                     $q->where('nama', 'LIKE', "%$search%");
                   })
                  ->orWhere('total', 'LIKE', "%$search%");
               });
            }
        })
       
        ->rawColumns(['action','tempat','status'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 3){
            $produk = Product::where('is_delete',0)->where('place_id',Auth::user()->place_id)->orderBy('nama','desc')->get();
            return view('penjualan.create', compact('produk'));
        }

        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Penjualan();
        $check = Penjualan::where('place_id', Auth::user()->place_id)->whereYear('tanggal',Carbon::now()->year)->orderBy('urutan','desc');
        if(count($check->get()) == 0){
            $urutan = 1;
            $invoice = Auth::user()->place->kode_invoice.Carbon::now()->year.Carbon::now()->format('m')."0001";
        }
        else{
            $inv = $check->first();
            $urutan = $inv->urutan+1;
            $u = str_pad(($inv->urutan+1), 4, '0', STR_PAD_LEFT);
            $invoice = Auth::user()->place->kode_invoice.Carbon::now()->year.Carbon::now()->format('m').$u;
        }
        $data->kode = $invoice;
        $data->urutan = $urutan;
        $data->user_id = Auth::user()->id;
        $data->tanggal = $request->tanggal;
        $data->keterangan = $request->keterangan;
        $data->place_id = Auth::user()->place_id;
        $data->status = $request->status == null ? 0:$request->status;
        $total = 0;
        $total_qty = 0;
        foreach ($request->qty as $key => $value) {
            $total += str_replace(".", "", $request->sub_total[$key]);
            $total_qty += $value;
        }
        $data->total = $total;
        $data->total_qty = $total_qty;
        $data->save();
        
        foreach ($request->product_id as $key => $value) {
            $detail = new PenjualanDetail();
            $detail->penjualan_id = $data->id;
            $detail->product_id = $value;
            $detail->harga = str_replace(".", "", $request->harga[$key]);
            $detail->qty = $request->qty[$key];
            $detail->sub_total = str_replace(".", "", $request->harga[$key]) * $request->qty[$key];
            $produk = Product::find($value);
            $detail->komisi = $produk->komisi;
            $detail->nominal_komisi = $detail->sub_total * $produk->komisi / 100;
            $detail->save();
        }

        return redirect()->route('penjualan.index')->with('success','Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penjualan::where('id', $id)->with('place','penjualan_detail.product')->first();
        return view('penjualan.show',compact('data'));
    }

    public function struk($id)
    {
        $data = Penjualan::where('id', $id)->with('place','penjualan_detail.product')->first();
        $pdf =  PDF::loadView('pdf.struk',['penjualan' => $data])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penjualan::find($id);
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
        //
    }

    public function change_status_all(Request $request)
    {
        Penjualan::where('status',0)->update(['status' => 1, 'tanggal_bayar' => Carbon::now()]);
        Session::flash('success', 'Berhasil'); 
        return 1;
    }

    public function change_status($id)
    {
        Penjualan::where('status',0)->where('id', $id)->update(['status' => 1, 'tanggal_bayar' => Carbon::now()]);
        Session::flash('success', 'Berhasil'); 
        return 1;
    }

    // public function invoice($id)
    // {
    //     $data = Penjualan::where('id', $id)->with('place','penjualan_detail.product')->first();
    //     $pdf =  PDF::loadView('penjualan.invoice',compact('data'))->setPaper('a4', 'portrait');
    //     return $pdf->stream();
    // }
}

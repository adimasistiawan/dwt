<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_produk = JenisProduk::where('is_delete', 0)->get();
        foreach ($jenis_produk as $key => $value) {
            $value->total = PenjualanDetail::whereHas('penjualan', function($q){
                $q->whereMonth('tanggal', Carbon::now()->month);
            })->whereHas('product', function($q) use($value){
                $q->where('jenis', $value->nama);
            })->sum('sub_total');;
        }
        return view('dashboard', compact('jenis_produk'));
    }

    public function filter(Request $request){
        if(Auth::user()->role != 3){

            $bar = Penjualan::whereMonth('tanggal', Carbon::now()->month)->select(DB::raw('SUM(total) as qty'),'tanggal as date')->groupBy('tanggal')->get();

            $jumlah_pengunjung = Penjualan::whereMonth('tanggal', Carbon::now()->month)->sum('total_qty');
            $jumlah_pendapatan = Penjualan::whereMonth('tanggal', Carbon::now()->month)->sum('total');
            $tiket = PenjualanDetail::whereHas('penjualan', function($q){
                $q->whereMonth('tanggal', Carbon::now()->month);
            })->whereHas('product', function($q){
                $q->where('jenis', 'Tiket');
            })->sum('sub_total');
            $package = PenjualanDetail::whereHas('penjualan', function($q){
                $q->whereMonth('tanggal', Carbon::now()->month);
            })->whereHas('product', function($q){
                $q->where('jenis', 'Package');
            })->sum('sub_total');;
            $akomodasi = PenjualanDetail::whereHas('penjualan', function($q){
                $q->whereMonth('tanggal', Carbon::now()->month);
            })->whereHas('product', function($q){
                $q->where('jenis', 'Akomodasi');
            })->sum('sub_total');
            $status = ['tiket'=>number_format($tiket , 0, ',', '.'), 'package'=>number_format($package , 0, ',', '.'), 'akomodasi'=> number_format($akomodasi , 0, ',', '.'), 'jumlah_pengunjung'=> number_format($jumlah_pengunjung , 0, ',', '.'), 'jumlah_pendapatan'=> number_format($jumlah_pendapatan , 0, ',', '.')];
        }
        else{
            $bar = Penjualan::where('place_id', Auth::user()->place_id)->whereMonth('tanggal', Carbon::now()->month)->select(DB::raw('SUM(total) as qty'),'tanggal as date')->groupBy('tanggal')->get();

            $jumlah_pengunjung = Penjualan::where('place_id', Auth::user()->place_id)->whereMonth('tanggal', Carbon::now()->month)->sum('total_qty');
            $jumlah_pendapatan = Penjualan::where('place_id', Auth::user()->place_id)->whereMonth('tanggal', Carbon::now()->month)->sum('total');
            $tiket = 0;
            $package = 0;
            $akomodasi = 0;
            $status = ['tiket'=>number_format($tiket , 0, ',', '.'), 'package'=>number_format($package , 0, ',', '.'), 'akomodasi'=> number_format($akomodasi , 0, ',', '.'), 'jumlah_pengunjung'=> number_format($jumlah_pengunjung , 0, ',', '.'), 'jumlah_pendapatan'=> number_format($jumlah_pendapatan , 0, ',', '.')];
        }
      
        // dd(['bar' => $bar, 'total' => $status]);
        return ['penjualan' => $bar, 'total' => $status];
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
        //
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
}

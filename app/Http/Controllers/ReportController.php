<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Place;
use App\Models\Product;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Riskihajar\Terbilang\Facades\Terbilang;

class ReportController extends Controller
{
    public function invoice()
    {
        $place = Place::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('report.invoice', compact('place'));
    }

    public function invoice_data(Request $request)
    {
        $produk = Product::orderBy('nama','desc')->where('place_id', $request->id)->get();
        foreach ($produk as $key => $value) {
            $data = PenjualanDetail::where('product_id', $value->id)->whereHas('penjualan', function($q) use ($request){
                $q->whereMonth('tanggal',$request->bulan)->whereYear('tanggal', $request->tahun)->where('place_id', $request->id);
            });
            if($data->count() > 0){
                $value->harga = $data->get()[0]->harga;
                $value->jumlah_penjualan = $data->sum('qty');
                $value->total_pendapatan = $data->sum('sub_total');
                $value->pendapatan_desa_wisata = $data->sum('nominal_komisi');
                $value->pendapatan_objek_wisata = $data->sum('sub_total') - $value->pendapatan_desa_wisata;
            }else{
                unset($produk[$key]);
            }
        }

        $no_invoice = Place::find($request->id)->kode_invoice.$request->tahun.str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
        return['no_invoice' => $no_invoice, 'penjualan' => $produk, 'tempat_wisata'=> Place::find($request->id)->nama, 'tahun' => $request->tahun, 'bulan' => month($request->bulan)];
    }

    public function invoice_pdf($id, $tahun, $bulan)
    {
        $produk = Product::orderBy('nama','desc')->where('place_id', $id)->get();
        foreach ($produk as $key => $value) {
            $data = PenjualanDetail::where('product_id', $value->id)->whereHas('penjualan', function($q) use ($id, $bulan, $tahun){
                $q->whereMonth('tanggal',$bulan)->whereYear('tanggal', $tahun)->where('place_id', $id);
            });
            if($data->count() > 0){
                $value->harga = $data->get()[0]->harga;
                $value->jumlah_penjualan = $data->sum('qty');
                $value->total_pendapatan = $data->sum('sub_total');
                $value->pendapatan_desa_wisata = $data->sum('nominal_komisi');
                $value->pendapatan_objek_wisata = $data->sum('sub_total') - $value->pendapatan_desa_wisata;
            }else{
                unset($produk[$key]);
            }
        }

        $no_invoice = Place::find($id)->kode_invoice.$tahun.str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $pdf =  PDF::loadView('pdf.invoice',['no_invoice' => $no_invoice, 'penjualan' => $produk, 'tempat_wisata'=> Place::find($id)->nama, 'tahun' => $tahun, 'bulan' => month($bulan)])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function kuitansi()
    {
        $place = Place::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('report.kuitansi', compact('place'));
    }

    public function kuitansi_data(Request $request)
    {
        $produk = Product::orderBy('nama','desc')->where('place_id', $request->id)->get();
        $total = 0;
        foreach ($produk as $key => $value) {
            $data = PenjualanDetail::where('product_id', $value->id)->whereHas('penjualan', function($q) use ($request){
                $q->whereMonth('tanggal',$request->bulan)->whereYear('tanggal', $request->tahun)->where('place_id', $request->id);
            });
            if($data->count() > 0){
                $value->pendapatan_desa_wisata = $data->sum('nominal_komisi');
                $total +=  $value->pendapatan_desa_wisata;
            }else{
                unset($produk[$key]);
            }
        }

        $no_invoice = Place::find($request->id)->kode_invoice.$request->tahun.str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
        $no = 'KUT/'.Place::find($request->id)->kode_invoice.'/'.$request->tahun.'/'.str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
        $terbilang = Terbilang::make($total);
        return['no_invoice' => $no_invoice, 'tempat_wisata'=> Place::find($request->id)->nama, 'total' => $total, 'no' => $no, 'terbilang' => $terbilang];
    }

    public function kuitansi_pdf($id, $tahun, $bulan, $tanggal)
    {
        $produk = Product::orderBy('nama','desc')->where('place_id', $id)->get();
        $total = 0;
        foreach ($produk as $key => $value) {
            $data = PenjualanDetail::where('product_id', $value->id)->whereHas('penjualan', function($q) use ($id, $bulan, $tahun){
                $q->whereMonth('tanggal',$bulan)->whereYear('tanggal', $tahun)->where('place_id', $id);
            });
            if($data->count() > 0){
                $value->pendapatan_desa_wisata = $data->sum('nominal_komisi');
                $total +=  $value->pendapatan_desa_wisata;
            }else{
                unset($produk[$key]);
            }
        }

        $no_invoice = Place::find($id)->kode_invoice.$tahun.str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $no = 'KUT/'.Place::find($id)->kode_invoice.'/'.$tahun.'/'.str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $terbilang = Terbilang::make($total);
        $pdf =  PDF::loadView('pdf.kuitansi',['no_invoice' => $no_invoice, 'tempat_wisata'=> Place::find($id)->nama, 'total' => $total, 'no' => $no, 'tanggal'=>$tanggal,'terbilang' => $terbilang])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function perkiraan_pendapatan()
    {
        $place = Place::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('report.perkiraan_pendapatan', compact('place'));
    }

    public function perkiraan_pendapatan_data(Request $request)
    {
        if($request->id != "Semua"){
            $place = Place::where('id', $request->id)->orderBy('created_at','asc')->get();
            $tempat_wisata = $place[0]->nama;
        }
        else{
            $place = Place::orderBy('created_at','asc')->get();
            $tempat_wisata = "Semua";
        }
        
        foreach ($place as $key => $value) {
            $data = PenjualanDetail::whereHas('penjualan', function($q) use ($request, $value){
                $q->whereDate('tanggal','>=',$request->dari)->whereDate('tanggal', '<=', $request->sampai)->where('place_id', $value->id);
            });
            $value->jumlah_penjualan = $data->sum('qty');
            $pendapatan_desa_wisata = 0;
            foreach ($data->get() as $key => $penjualan) {
                $pendapatan_desa_wisata += $penjualan->nominal_komisi;
            }
            $value->pendapatan_desa_wisata = $pendapatan_desa_wisata;
            $value->pendapatan_objek_wisata = $data->sum('sub_total');
            
        }
        return ['penjualan' => $place, 'tempat_wisata'=>$tempat_wisata, 'dari' => date('d-m-Y', strtotime($request->dari)), 'sampai' => date('d-m-Y', strtotime($request->sampai))];
    }

    public function perkiraan_pendapatan_pdf($id, $dari, $sampai)
    {
        if($id != "Semua"){
            $place = Place::where('id', $id)->orderBy('created_at','asc')->get();
            $tempat_wisata = $place[0]->nama;
        }
        else{
            $place = Place::orderBy('created_at','asc')->get();
            $tempat_wisata = "Semua";
        }
        
        foreach ($place as $key => $value) {
            $data = PenjualanDetail::whereHas('penjualan', function($q) use ($dari, $sampai, $value){
                $q->whereDate('tanggal','>=',$dari)->whereDate('tanggal', '<=', $sampai)->where('place_id', $value->id);
            });
            $value->jumlah_penjualan = $data->sum('qty');
            $pendapatan_desa_wisata = 0;
            foreach ($data->get() as $key => $penjualan) {
                $pendapatan_desa_wisata += $penjualan->nominal_komisi;
            }
            $value->pendapatan_desa_wisata = $pendapatan_desa_wisata;
            $value->pendapatan_objek_wisata = $data->sum('sub_total');
            
        }
        $pdf =  PDF::loadView('pdf.perkiraan_pendapatan',['penjualan' => $place, 'tempat_wisata'=>$tempat_wisata, 'dari' => date('d-m-Y', strtotime($dari)), 'sampai' => date('d-m-Y', strtotime($sampai))])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function rekapitulasi_pendapatan()
    {
        $place = Place::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('report.rekapitulasi_pendapatan', compact('place'));
    }

    public function rekapitulasi_pendapatan_data(Request $request)
    {
        if($request->id != "Semua"){
            $place = Place::where('id', $request->id)->orderBy('created_at','asc')->get();
            $tempat_wisata = $place[0]->nama;
        }
        else{
            $place = Place::orderBy('created_at','asc')->get();
            $tempat_wisata = "Semua";
        }
        
        foreach ($place as $key => $value) {
            $data = PenjualanDetail::whereHas('penjualan', function($q) use ($request, $value){
                $q->whereDate('tanggal','>=',$request->dari)->whereDate('tanggal', '<=', $request->sampai)->where('place_id', $value->id)->where('status',1);
            });
            $value->jumlah_penjualan = $data->sum('qty');
            $pendapatan_desa_wisata = 0;
            foreach ($data->get() as $key => $penjualan) {
                $pendapatan_desa_wisata += $penjualan->nominal_komisi;
            }
            $value->pendapatan_desa_wisata = $pendapatan_desa_wisata;
            $value->pendapatan_objek_wisata = $data->sum('sub_total');
            
        }
        return ['penjualan' => $place, 'tempat_wisata'=>$tempat_wisata, 'dari' => date('d-m-Y', strtotime($request->dari)), 'sampai' => date('d-m-Y', strtotime($request->sampai))];
    }

    public function rekapitulasi_pendapatan_pdf($id, $dari, $sampai)
    {
        if($id != "Semua"){
            $place = Place::where('id', $id)->orderBy('created_at','asc')->get();
            $tempat_wisata = $place[0]->nama;
        }
        else{
            $place = Place::orderBy('created_at','asc')->get();
            $tempat_wisata = "Semua";
        }
        
        foreach ($place as $key => $value) {
            $data = PenjualanDetail::whereHas('penjualan', function($q) use ($dari, $sampai, $value){
                $q->whereDate('tanggal','>=',$dari)->whereDate('tanggal', '<=', $sampai)->where('place_id', $value->id)->where('status',1);
            });
            $value->jumlah_penjualan = $data->sum('qty');
            $pendapatan_desa_wisata = 0;
            foreach ($data->get() as $key => $penjualan) {
                $pendapatan_desa_wisata += $penjualan->nominal_komisi;
            }
            $value->pendapatan_desa_wisata = $pendapatan_desa_wisata;
            $value->pendapatan_objek_wisata = $data->sum('sub_total');
            
        }
        $pdf =  PDF::loadView('pdf.rekapitulasi_pendapatan',['penjualan' => $place, 'tempat_wisata'=>$tempat_wisata, 'dari' => date('d-m-Y', strtotime($dari)), 'sampai' => date('d-m-Y', strtotime($sampai))])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function get_produk($id)
    {
        $data = Product::where('place_id', $id)->get();
        return $data;
    }

    public function produk()
    {
        $place = Place::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('report.produk', compact('place'));
    }

    public function produk_data(Request $request)
    {
        $data = PenjualanDetail::where('product_id', $request->product_id)->whereHas('penjualan', function($q) use ($request){
            $q->where('place_id', $request->place_id)->whereDate('tanggal','>=',$request->dari)->whereDate('tanggal', '<=', $request->sampai);
        })->with('penjualan')->get();

        $place = Place::find($request->place_id);
        $tempat_wisata = $place->nama;

        $product = Product::find($request->product_id);
        $nama_produk = $product->nama;
        $komisi = $product->komisi;
        return ['penjualan' => $data, 'tempat_wisata'=>$tempat_wisata, 'nama_produk'=>$nama_produk, 'komisi'=>$komisi,'dari' => date('d-m-Y', strtotime($request->dari)), 'sampai' => date('d-m-Y', strtotime($request->sampai))];
    }

    public function produk_pdf($place_id, $product_id, $dari, $sampai)
    {
        $data = PenjualanDetail::where('product_id', $product_id)->whereHas('penjualan', function($q) use ($place_id, $dari, $sampai){
            $q->where('place_id', $place_id)->whereDate('tanggal','>=',$dari)->whereDate('tanggal', '<=', $sampai);
        })->with('penjualan')->get();

        $place = Place::find($place_id);
        $tempat_wisata = $place->nama;

        $product = Product::find($product_id);
        $nama_produk = $product->nama;
        $komisi = $product->komisi;
        $pdf =  PDF::loadView('pdf.produk',['penjualan' => $data, 'tempat_wisata'=>$tempat_wisata, 'nama_produk'=>$nama_produk, 'komisi'=>$komisi,'dari' => date('d-m-Y', strtotime($dari)), 'sampai' => date('d-m-Y', strtotime($sampai))])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}

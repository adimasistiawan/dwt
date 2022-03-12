@extends('template')
@section('title')
    Invoice
@endsection
@section('css')
    
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Invoice</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Laporan</li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Page-content-Wrapper -->
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Invoice</h4>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <label for="">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control select2-filter">
                                        <option value="1" @if(\Carbon\Carbon::now()->month == 1) selected @endif>Januari</option>
                                        <option value="2" @if(\Carbon\Carbon::now()->month == 2) selected @endif>Februari</option>
                                        <option value="3" @if(\Carbon\Carbon::now()->month == 3) selected @endif>Maret</option>
                                        <option value="4" @if(\Carbon\Carbon::now()->month == 4) selected @endif>April</option>
                                        <option value="5" @if(\Carbon\Carbon::now()->month == 5) selected @endif>Mei</option>
                                        <option value="6" @if(\Carbon\Carbon::now()->month == 6) selected @endif>Juni</option>
                                        <option value="7" @if(\Carbon\Carbon::now()->month == 7) selected @endif>Juli</option>
                                        <option value="8" @if(\Carbon\Carbon::now()->month == 8) selected @endif>Agustus</option>
                                        <option value="9" @if(\Carbon\Carbon::now()->month == 9) selected @endif>September</option>
                                        <option value="10" @if(\Carbon\Carbon::now()->month == 10) selected @endif>Oktober</option>
                                        <option value="11" @if(\Carbon\Carbon::now()->month == 11) selected @endif>November</option>
                                        <option value="12" @if(\Carbon\Carbon::now()->month == 12) selected @endif>Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    @php
                                        $now = \Carbon\Carbon::now()->year;
                                        $year = 2020;
                                    @endphp
                                    <label for="">Tahun</label>
                                    <select name="tahun" id="tahun" class="select2 form-control" style="width: 100%;" required>
                                       @while ($year <= $now)
                                           <option value="{{$now}}">{{$now}}</option>
                                           @php
                                               $now--;
                                           @endphp
                                       @endwhile
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Tempat Wisata</label>
                                    <select name="tempat_wisata" id="tempat_wisata" class="form-control select2-filter-search">
                                        <option value=""></option>
                                        @foreach ($place as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-info search mt-2">Lihat</button>
                            <div class="mt-4 report" hidden>
                                <div class="export">
                                    
                                </div>
                                <div class="table-responsive mt-1 report-table" style="font-size: 11px;" hidden>
                                    <div class="w-100 text-center">

                                        <b><u>INVOICE</u></b> 
                                        <br>
                                        <span>NO : <span class="no_invoice"></span></span>
                                    </div>
                                    <b>Tempat Wisata : <span class="tempat_wisata"></span></b><br>
                                    <b>Tahun : <span class="tahun"></span></b><br>
                                    <b>Bulan : <span class="bulan"></span></b>
                                    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;" >
                                        <thead>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Jumlah Penjualan</th>
                                            <th class="text-center">Total Pendapatan</th>
                                            <th class="text-center">Pendapatan Objek Wisata</th>
                                            <th class="text-center">Pendapatan Desa Wisata</th>
                                        </thead>
                                        <tbody class="tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- End Page-content -->
    </div>
   
@endsection

@section('js')
    <script>
        
        $(function(){
            $('.select2-filter-search').select2({
                placeholder:"Pilih"
            })

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $('.search').click(function(){
                $('.export').empty();
                $('.loading').removeAttr('hidden')
                $('.tbody').empty();
                $('.report').removeAttr('hidden')
                $('.report-table').attr('hidden',false)
                var urls='{{route('report.invoice.data')}}';
                _token = $('input[name=_token]').val();
                var id = $('#tempat_wisata').val()
                var tahun = $('#tahun').val()
                var bulan = $('#bulan').val()
                var url = "{{route('report.invoice.pdf',['id' => ':id', 'tahun' => ':tahun', 'bulan' => ':bulan'])}}";
                url = url.replace(':id', id);
                url = url.replace(':tahun', tahun);
                url = url.replace(':bulan', bulan);
                $('.export').append(
                    `<a class="btn btn-primary" href="`+url+`" target="blank"> Cetak</a>`
                )
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {_token:_token, id:id, tahun:tahun, bulan:bulan},
                    url: urls,
                })
                .done(function(response) {
                $('.no_invoice').text(response['no_invoice'])
                $('.tempat_wisata').text(response['tempat_wisata'])
                $('.tahun').text(response['tahun'])
                $('.bulan').text(response['bulan'])
                if(response['penjualan'].length != 0){
                    console.log(response)
                    let total = 0
                    $.each(response['penjualan'],function(k,value){
                        
                        $('.tbody').append(`
                        <tr>
                            <td class="text-left">`+value.nama+`</td>
                            <td class="text-right">`+numberWithCommas(value.harga)+`</td>
                            <td class="text-right">`+numberWithCommas(value.jumlah_penjualan)+`</td>
                            <td class="text-right">`+numberWithCommas(value.total_pendapatan)+`</td>
                            <td class="text-right">`+numberWithCommas(value.pendapatan_objek_wisata)+`</td>
                            <td class="text-right">`+numberWithCommas(value.pendapatan_desa_wisata)+`</td>
                        </tr>
                        `)
                        total+=value.pendapatan_desa_wisata
                    });
                    $('.tbody').append(`
                        <tr>
                            <th class="text-right" colspan="5">Total</th>
                            <th class="text-right">`+numberWithCommas(total)+`</th>
                        </tr>
                        `)
                    $('.loading').attr('hidden',true)
                }
                else{
                    $('.tbody').append(`
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada</td>
                        
                    </tr>
                    `)
                }
                $('.loading').attr('hidden',true)
                })
                
            })
        })
     
    </script>
@endsection
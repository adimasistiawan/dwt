@extends('template')
@section('title')
    Kuitansi
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
                        <h4 class="mb-0 font-size-18">Kuitansi</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Laporan</li>
                            <li class="breadcrumb-item active">Kuitansi</li>
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
                            <h4 class="card-title">Kuitansi</h4>
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
                                    <label class="form-label">Rekanan Usaha</label>
                                    <select name="tempat_wisata" id="tempat_wisata" class="form-control select2-filter-search">
                                        <option value=""></option>
                                        @foreach ($place as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Tanggal Bayar</label>
                                    <input type="date" name="tanggal_bayar" id="tanggal" class="form-control">
                                </div>
                            </div>
                            <button class="btn btn-info search mt-2">Lihat</button>
                            <div class="mt-4 report" hidden>
                                <div class="export">
                                    
                                </div>
                                <div  style="padding-left:100px; padding-right:100px;">

                                    <div class="table-responsive mt-3 report-table" style="font-size: 16px; border:1px solid #000000; padding-left:100px;  padding-right:100px;" hidden>
                                        <div class="w-100 text-center" style=" padding-top:50px; ">
    
                                            <b><u>KUITANSI</u></b> 
                                            <br>
                                            <span>NO : <span class="no"></span></span>
                                        </div>
                                        <span class="tanggal float-end"></span>
                                        <br>
                                        <br>
                                        <div style=" padding-bottom:50px;">
                                            <table>
                                                <tr>
                                                    <td><b>Telah Diterima Dari</b></td>
                                                    <td width="30px" align="center">:</td>
                                                    <td><span class="dari"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Sejumlah Uang</b></td>
                                                    <td width="30px" align="center">:</td>
                                                    <td><span class="total"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Untuk Pembayaran</b></td>
                                                    <td width="30px" align="center">:</td>
                                                    <td><span class="no_invoice"></span></td>
                                                </tr>
                                            </table>
                                            {{-- <b>Telah Diterima Dari : <span class="dari"></span></b><br>
                                            <b>Sejumlah Uang : <span class="total"></span></b><br>
                                            <b>Untuk Pembayaran : <span class="no_invoice"></span></b> --}}
                                        </div>
                                       
                                    </div>
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
                if($('#tempat_wisata').val() == ''){
                    return false;
                }
                $('.export').empty();
                $('.loading').removeAttr('hidden')
                $('.tbody').empty();
                $('.report').removeAttr('hidden')
                $('.report-table').attr('hidden',false)
                var urls='{{route('report.kuitansi.data')}}';
                _token = $('input[name=_token]').val();
                var id = $('#tempat_wisata').val()
                var tahun = $('#tahun').val()
                var bulan = $('#bulan').val()
                var tanggal = $('#tanggal').val()
                var url = "{{route('report.kuitansi.pdf',['id' => ':id', 'tahun' => ':tahun', 'bulan' => ':bulan','tanggal'=>':tanggal'])}}";
                url = url.replace(':id', id);
                url = url.replace(':tahun', tahun);
                url = url.replace(':bulan', bulan);
                url = url.replace(':tanggal', tanggal);
                $('.export').append(
                    `<a class="btn btn-primary" href="`+url+`" target="blank"> Cetak</a>`
                )
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {_token:_token, id:id, tahun:tahun, bulan:bulan, tanggal:tanggal},
                    url: urls,
                })
                .done(function(response) {
                    console.log(response)
                    $('.no_invoice').text(response['no_invoice'])
                    $('.no').text(response['no'])
                    $('.dari').text(response['tempat_wisata'])
                    $('.total').text(numberWithCommas(response['total']))
                    $('.tanggal').text(moment(tanggal).format("DD-MM-YYYY"))

                    $('.loading').attr('hidden',true)
                })
                
            })
        })
     
    </script>
@endsection
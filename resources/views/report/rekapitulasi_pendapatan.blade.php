@extends('template')
@section('title')
    Rekapitulasi Pendapatan
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
                        <h4 class="mb-0 font-size-18">Rekapitulasi Pendapatan</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Laporan</li>
                            <li class="breadcrumb-item active">Rekapitulasi Pendapatan</li>
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
                            <h4 class="card-title">Rekapitulasi Pendapatan</h4>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" class="form-control" id="dari">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" class="form-control" id="sampai">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Tempat Wisata</label>
                                    <select name="tempat_wisata" id="tempat_wisata" class="form-control select2-filter">
                                        <option value="Semua">Semua</option>
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

                                        <b><u>LAPORAN REKAPITULASI PENDAPATAN</u></b>
                                    </div>
                                    <b>Tempat Wisata : <span class="tempat_wisata"></span></b><br>
                                    <b>Dari Tanggal : <span class="dari"></span></b><br>
                                    <b>Sampai Tanggal : <span class="sampai"></span></b>
                                    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;" >
                                        <thead>
                                            <th class="text-center" width="50px">No</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Jumlah Pengunjung</th>
                                            <th class="text-center">Pendapatan Objek Wisata</th>
                                            <th class="text-center">Pendapatan Unit Desa Wisata</th>
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
                var urls='{{route('report.rekapitulasi_pendapatan.data')}}';
                _token = $('input[name=_token]').val();
                var id = $('#tempat_wisata').val()
                var dari = $('#dari').val()
                var sampai = $('#sampai').val()
                var url = "{{route('report.rekapitulasi_pendapatan.pdf',['id' => ':id', 'dari' => ':dari', 'sampai' => ':sampai'])}}";
                url = url.replace(':id', id);
                url = url.replace(':dari', dari);
                url = url.replace(':sampai', sampai);
                $('.export').append(
                    `<a class="btn btn-primary" href="`+url+`" target="blank"> Cetak</a>`
                )
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {_token:_token, id:id, dari:dari, sampai:sampai},
                    url: urls,
                })
                .done(function(response) {
                $('.tempat_wisata').text(response['tempat_wisata'])
                $('.dari').text(response['dari'])
                $('.sampai').text(response['sampai'])
                if(response['penjualan'].length != 0){
                    console.log(response)
                    let total = 0
                    let no = 1
                    $.each(response['penjualan'],function(k,value){
                        
                        $('.tbody').append(`
                        <tr>
                            <td class="text-left">`+no+`</td>
                            <td class="text-left">`+value.nama+`</td>
                            <td class="text-right">`+numberWithCommas(parseInt(value.jumlah_penjualan))+`</td>
                            <td class="text-right">`+numberWithCommas(value.pendapatan_objek_wisata)+`</td>
                            <td class="text-right">`+numberWithCommas(value.pendapatan_desa_wisata)+`</td>
                        </tr>
                        `)
                        total+=value.pendapatan_desa_wisata
                        no++
                       
                    });
                    $('.tbody').append(`
                        <tr>
                            <th class="text-right" colspan="4">Total</th>
                            <th class="text-right">`+numberWithCommas(total)+`</th>
                        </tr>
                        `)
                    $('.loading').attr('hidden',true)
                }
                else{
                    $('.tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada</td>
                        
                    </tr>
                    `)
                }
                $('.loading').attr('hidden',true)
                })
                
            })
        })
     
    </script>
@endsection
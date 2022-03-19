@extends('template')
@section('title')
    Produk
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
                        <h4 class="mb-0 font-size-18">Produk</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Laporan</li>
                            <li class="breadcrumb-item active">Produk</li>
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
                            <h4 class="card-title">Produk</h4>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <label class="form-label">Rekanan Usaha</label>
                                    <select name="tempat_wisata" id="tempat_wisata" class="form-control select2-filter">
                                        <option value=""></option>
                                        @foreach ($place as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Produk</label>
                                    <select name="produk" id="produk" class="form-control select2-filter" disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" class="form-control" id="dari">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" class="form-control" id="sampai">
                                </div>
                              
                            </div>
                            <button class="btn btn-info search mt-2">Lihat</button>
                            <div class="mt-4 report" hidden>
                                <div class="export">
                                    
                                </div>
                                <div class="table-responsive mt-1 report-table" style="font-size: 11px;" hidden>
                                    <div class="w-100 text-center">

                                        <b><u>LAPORAN PRODUK</u></b>
                                    </div>
                                    <b>Rekanan Usaha : <span class="tempat_wisata"></span></b><br>
                                    <b>Nama Produk : <span class="nama_produk"></span></b><br>
                                    <b>Dari Tanggal : <span class="dari"></span></b><br>
                                    <b>Sampai Tanggal : <span class="sampai"></span></b>
                                    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;" >
                                        <thead>
                                            <th class="text-center">Kode Penjualan</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Kuantitas</th>
                                            <th class="text-center">Sub Total</th>
                                            <th class="text-center">Keterangan</th>
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
            $('.select2-filter').select2({
                placeholder:"Pilih"
            })

            $('#tempat_wisata').change(function(){
                $('.loading').removeAttr('hidden')
                var id = $(this).val()
                var url = "{{route('report.get_produk',['id' => ':id'])}}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: url,
                })
                .done(function(response) {
                    $('#produk').empty()
                    $('#produk').prop('disabled', false)
                    $('#produk').append(`
                    <option value=""></option>
                    `)
                    $.each(response, function(k, value){
                        $('#produk').append(`
                        <option value="`+value.id+`">`+value.nama+`</option>
                        `)
                    })
                    $('.loading').attr('hidden',true)
                })
            })

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $('.search').click(function(){
                if($('#dari').val() == '' || $('#sampai').val() == '' || $('#tempat_wisata').val() == '' || $('#produk').val() == ''){
                    return false;
                }
                $('.export').empty();
                $('.loading').removeAttr('hidden')
                $('.tbody').empty();
                $('.report').removeAttr('hidden')
                $('.report-table').attr('hidden',false)
                var urls='{{route('report.produk.data')}}';
                _token = $('input[name=_token]').val();
                var place_id = $('#tempat_wisata').val()
                var product_id = $('#produk').val()
                console.log(product_id)
                var dari = $('#dari').val()
                var sampai = $('#sampai').val()
                var url = "{{route('report.produk.pdf',['place_id' => ':place_id', 'product_id' => ':product_id', 'dari' => ':dari', 'sampai' => ':sampai'])}}";
                url = url.replace(':place_id', place_id);
                url = url.replace(':product_id', product_id);
                url = url.replace(':dari', dari);
                url = url.replace(':sampai', sampai);
                $('.export').append(
                    `<a class="btn btn-primary" href="`+url+`" target="blank"> Cetak</a>`
                )
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {_token:_token, place_id:place_id, product_id:product_id, dari:dari, sampai:sampai},
                    url: urls,
                })
                .done(function(response) {
                $('.tempat_wisata').text(response['tempat_wisata'])
                $('.nama_produk').text(response['nama_produk'])
                $('.dari').text(response['dari'])
                $('.sampai').text(response['sampai'])
                if(response['penjualan'].length != 0){
                    let total = 0
                    $.each(response['penjualan'],function(k,value){
                        
                        $('.tbody').append(`
                        <tr>
                            <td class="text-left">`+value.penjualan.kode+`</td>
                            <td class="text-center">`+moment(value.penjualan.tanggal).format("DD-MM-YYYY")+`</td>
                            <td class="text-right">`+numberWithCommas(parseInt(value.harga))+`</td>
                            <td class="text-right">`+numberWithCommas(parseInt(value.qty))+`</td>
                            <td class="text-right">`+numberWithCommas(parseInt(value.sub_total))+`</td>
                            <td class="text-left">`+(value.penjualan.keterangan == null? "":value.penjualan.keterangan)+`</td>
                        </tr>
                        `)
                        total+=parseInt(value.sub_total)
                       
                    });
                    $('.tbody').append(`
                        <tr>
                            <th class="text-right" colspan="4">Total</th>
                            <th class="text-right">`+numberWithCommas(total)+`</th>
                            <td></td>
                        </tr>
                        `)
                        $('.tbody').append(`
                        <tr>
                            <th class="text-right" colspan="4">Komisi `+response['komisi']+`%</th>
                            <th class="text-right" >`+numberWithCommas((parseInt(total) * parseFloat(response['komisi']) / 100 ))+`</th>
                            <td></td>
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
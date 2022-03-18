@extends('template')
@section('title')
    Beranda
@endsection
@section('css')
    <style>
         .text-warning{
                  color: #f5b22 !important;
              }
    </style>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Beranda</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                    </div>
                    <div class="state-informatio d-sm-block">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start page content-wrapper -->
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-md-3">
                  @csrf
                  {{-- <div class="form-group">
                    <label for="" class="text-warning">Periode</label>
                    <select name="filter" id="Filter" class="filter form-control" >
                      <option value="1">7 Hari Terakhir</option>
                      <option value="2">90 Hari Terakhir</option>
                      <option value="3" selected>Bulan Ini</option>
                      <option value="4">Bulan Sebelumnya</option>
                      <option value="5">Custom</option>
                    </select>
                  </div>
            
                </div>
                
                  <div class="col-md-3 custom" hidden>
                    <div class="form-group">
                        <label for="" class="text-warning">Dari</label>
                        <input type="date" class="form-control input-cari dari" id="from" name="from">
                    </div>
                  </div>
                  <div class="col-md-3 custom" hidden>
                    <div class="form-group">
                        <label for="" class="text-warning">Sampai</label>
                        <input type="date" class="form-control input-cari sampai" id="to" name="to">
                    </div>
                  </div>
                  <div class="col-md-3 custom" hidden>
                    <br>
                    <button class="btn btn-primary btn-cari" style="margin-top:8px">Cari</button>
                  </div> --}}
            </div>
            <div class="row mt-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">
                                </h5>
                                <div class="text-white">
                                    <h5 class="text-uppercase font-size-16 text-white-50">Jumlah Pengunjung</h5>
                                    <h3 class="mb-3 text-white jumlah-pengunjung">0</h3>
                                   
                                </div>
                                <div class="mini-stat-icon">
                                    {{-- <i class="mdi mdi-rename-box display-2"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-xl-9 col-md-6">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">
                                </h5>
                                <div class="text-white">
                                    <h5 class="text-uppercase font-size-16 text-white-50">Jumlah Pendapatan</h5>
                                    <h3 class="mb-3 text-white jumlah-pendapatan"></h3>
                                    
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-buffer display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Col -->
                @if (Auth::user()->role != 3)
                    
                @foreach ($jenis_produk as $item)
                    
                <div class="col-xl-4 col-md-12">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body">
                            <div class="mini-stat-desc">
                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">
                                </h5>
                                <div class="text-white">
                                    <h5 class="text-uppercase font-size-16 text-white-50">{{$item->nama}}</h5>
                                    <h3 class="mb-3 text-white">{{number_format($item->total , 0, ',', '.')}}</h3>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End Col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Penjualan</h4>


                            <canvas id="bar" height="50"></canvas>

                        </div>
                        <!-- End Cardbody-->
                    </div>
                    <!-- End Card-->
                </div>
            </div>
            @endif
            <!-- End Row -->

            {{-- <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-8 border-end">
                                    <h4 class="card-title mb-4">Sales Report</h4>
                                    <div id="morris-area-example" class="Beranda-charts morris-charts">
                                    </div>
                                </div>
                                <!-- End Col -->

                                <div class="col-xl-4">
                                    <h4 class="card-title mb-4">Yearly Sales Report</h4>
                                    <div class="p-3">
                                        <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-first-tab"
                                                    data-bs-toggle="pill" href="#pills-first" role="tab"
                                                    aria-controls="pills-first"
                                                    aria-selected="true">2015</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-second-tab"
                                                    data-bs-toggle="pill" href="#pills-second" role="tab"
                                                    aria-controls="pills-second"
                                                    aria-selected="false">2016</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-third-tab"
                                                    data-bs-toggle="pill" href="#pills-third" role="tab"
                                                    aria-controls="pills-third"
                                                    aria-selected="false">2017</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="pills-first"
                                                role="tabpanel" aria-labelledby="pills-first-tab">
                                                <div class="p-3">
                                                    <h2>$17562</h2>
                                                    <p class="text-muted">Maecenas nec odio et ante
                                                        tincidunt tempus. Donec vitae sapien ut libero
                                                        venenatis faucibus Nullam quis ante.</p>
                                                    <a href="#" class="text-primary">Read more...</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="pills-second" role="tabpanel"
                                                aria-labelledby="pills-second-tab">
                                                <div class="p-3">
                                                    <h2>$18614</h2>
                                                    <p class="text-muted">Maecenas nec odio et ante
                                                        tincidunt tempus. Donec vitae sapien ut libero
                                                        venenatis faucibus Nullam quis ante.</p>
                                                    <a href="#" class="text-primary">Read more...</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="pills-third" role="tabpanel"
                                                aria-labelledby="pills-third-tab">
                                                <div class="p-3">
                                                    <h2>$19752</h2>
                                                    <p class="text-muted">Maecenas nec odio et ante
                                                        tincidunt tempus. Donec vitae sapien ut libero
                                                        venenatis faucibus Nullam quis ante.</p>
                                                    <a href="#" class="text-primary">Read more...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Sales Analytics</h4>
                            <div id="morris-donut-example" class="Beranda-charts morris-charts"></div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Col -->
            </div> --}}
            <!-- end row -->

            

        </div>
        <!-- end page-content-wrapper-->

    </div>
    <!-- Container-fluid -->
</div>  
@endsection

@section('js')
<script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            getData()
           function getData(){
                var val = $('#Filter').val()
                urlsnya = '{{route('beranda.filter')}}';
                _token = $('input[name=_token]').val();

                var date = [];
                var jml =[];
                $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {_token:_token, val:val},
                url: urlsnya,
                })
                .done(function(response) {
                    console.log(response)
                    $('.loading').attr('hidden',true)
                    $('.jumlah-pengunjung').text(response['total']['jumlah_pengunjung'])
                    $('.jumlah-pendapatan').text('Rp. '+response['total']['jumlah_pendapatan'])
                    $('.tiket').text('Rp. '+response['total']['tiket'])
                    $('.package').text('Rp. '+response['total']['package'])
                    $('.akomodasi').text('Rp. '+response['total']['akomodasi'])
                    $.each(response['penjualan'],function(k,value){
                        date.push(value['date']);
                        jml.push(value['qty']);
                    });

                    var areaChartData = {
                        labels  : date,
                        datasets: [
                        {
                        label               : 'Penjualan',
                        backgroundColor     : '#3c8dbc',
                        borderColor         : '#3c8dbc',
                        pointRadius         : false,
                        pointColor          : '#3c8dbc',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : jml,

                        },
                        
                        ]
                    }
                    var barChartCanvas = $('#bar').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    

                    var barChartOptions = {
                        responsive              : true,
                        datasetFill             : true,
                        scales: {
                             yAxes: [{
                                 ticks: {
                                     beginAtZero: true,
                                     userCallback: function(label, index, labels) {
                                         // when the floored value is the same as the value we have a whole number
                                         if (Math.floor(label) === label) {
                                             return label;
                                         }
                    
                                     },
                                 }
                             }],
                         },

                    }

                    var barChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })

                })
            }
           
        })
    </script>
@endsection
@extends('template')
@section('title')
    Detail Penjualan
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
                        <h4 class="mb-0 font-size-18">Penjualan</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item">Penjualan</li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                    <div class="state-informatio d-sm-block">
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
                            <h4 class="card-title mb-4">Detail Penjualan</h4>
                            @if(Auth::user()->role == 3)
                            <a href="{{route('penjualan.struk',$data->id)}}" target="blank" class="btn btn-primary mb-4">Cetak Struk</a>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <h6>Kode Penjualan</h6>
                                        <span>{{$data->kode}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <h6>Tanggal</h6>
                                        <span>{{date('d-m-Y', strtotime($data->tanggal))}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <h6>Rekanan Usaha</h6>
                                        <span>{{$data->place->nama}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                
                                    <div class="mb-4">
                                        <h6>Total</h6>
                                        <span>{{ number_format($data->total , 0, ',', '.')}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <h6>Status</h6>
                                        @if ($data->status == 1)
                                        <span class='badge bg-success'>Sudah Dibayar</span>
                                        @else
                                        <span class='badge bg-danger'>Belum Dibayar</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <h6>Keterangan</h6>
                                        <span>{{$data->keterangan == null ? "-":$data->keterangan}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if ($data->status == 1)
                                    <div class="mb-4">
                                        <h6>Tanggal Bayar</h6>
                                        <span>{{date('d-m-Y', strtotime($data->tanggal_bayar))}}</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="width: 100%">
                                          <thead>
                                            <th style="text-align: center" width="25%">Produk</th>
                                            <th style="text-align: center" width="25%">Harga</th>
                                            <th style="text-align: center" width="25%">Kuantitas</th>
                                            <th style="text-align: center" width="25%">Sub Total</th>
                                          </thead>
                                          <tbody id="tbody">
                                                @foreach ($data->penjualan_detail as $item)
                                                    
                                                <tr class="tr">
                                                  <td>
                                                      {{$item->product->nama}}
                                                  </td>
                                                  <td align="right">
                                                    {{ number_format($item->harga , 0, ',', '.');}}
                                                  </td>
                                                  <td align="center">
                                                    {{$item->qty}}
                                                  </td>
                                                  <td align="right">
                                                    {{ number_format($item->sub_total , 0, ',', '.');}}
                                                  </td>
                                                </tr>
                                                @endforeach
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="2">
                                              </td>
                                              <td align="right">
                                                  <b>Total</b>
                                              </td>
                                              <td align="right">
                                                <b id="total">{{ number_format($data->total , 0, ',', '.');}}</b>
                                              </td>
                                            </tr>
                                          </tfoot>
                                        </table>
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
    </script>
@endsection
@extends('template')
@section('title')
    Penjualan Sudah Bayar
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
                        <h4 class="mb-0 font-size-18">Penjualan Sudah Bayar</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Penjualan Sudah Bayar</li>
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
                            <h4 class="card-title">Penjualan</h4>
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
                                    <label class="form-label">Rekanan Usaha</label>
                                    <select name="tempat_wisata" id="tempat_wisata" class="form-control select2-filter-search">
                                        <option value="">Semua</option>
                                        @foreach ($place as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive mt-4 w-100">
                                <table id="datatable-server" class="table table-bordered  nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">No</th>
                                            <th>Kode Penjualan</th>
                                            <th>Tanggal</th>
                                            <th>Rekanan Usaha</th>
                                            <th>Total</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                       
                                    </tbody>
                                </table>
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
            let table = $("#datatable-server").DataTable({
                processing: true,
                serverSide: true,
                scrollX:true,
                "language": {
                    "lengthMenu": "Lihat _MENU_ data per halaman",
                    "zeroRecords": "Tidak Ada",
                    "info": "Menampilkan halaman ke _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak Ada",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search":"Cari",
                    "paginate": {
                        "next":       "Selanjutnya",
                        "previous":   "Sebelumnya"
                    },
                },
                ajax: {
                    url: "{{ route('penjualan.sudah_bayar.data') }}",
                    data: function (d) {
                            d.dari = $('#dari').val(),
                            d.sampai = $('#sampai').val(),
                            d.search = $('input[type="search"]').val()
                            d.tempat_wisata = $('#tempat_wisata').val()
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'kode', name: 'kode'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width: '20%'},
                ],
                columnDefs:[
                    {
                        targets: [0],
                        width: '5%',
                    }
                    
                ]
            });

            $('#dari').change(function(){
                table.draw();
            });
            $('#sampai').change(function(){
                table.draw();
            });
            $('#tempat_wisata').change(function(){
                table.draw();
            });

            $(document).on('click','.btn-change-all',function(){
                var id = $(this).attr('data-id')
                var url = "{{route('penjualan.change-status-all')}}";
                _token = $('input[name=_token]').val();
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    text:"Semua penjualan yang memiliki status 'belum dibayar' akan diubah menjadi 'sudah dibayar'",
                    showCancelButton: true,
                    confirmButtonColor: "#35a989",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal",
                    icon:"warning",
                    preConfirm: ()=>{
                        $.ajax({
                            url: url, 
                            data: {
                                '_token':_token
                            },
                            dataType: 'json',                         
                            type: 'post',
                            success: function(resp){
                                if(resp == 1){
                                    window.location = '{{route("penjualan.sudah_bayar")}}';
                                }
                            }
                        });
                    }
                })
            })

            $(document).on('click','.btn-change-status',function(){
                var id = $(this).attr('data-id')
                var url = "{{route('penjualan.change-status',':id')}}";
                url = url.replace(':id',id)
                _token = $('input[name=_token]').val();
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    text:"Status penjualan akan diubah menjadi 'belum dibayar'",
                    showCancelButton: true,
                    confirmButtonColor: "#35a989",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal",
                    icon:"warning",
                    preConfirm: ()=>{
                        $.ajax({
                            url: url, 
                            data: {
                                '_token':_token
                            },
                            dataType: 'json',                         
                            type: 'post',
                            success: function(resp){
                                if(resp == 1){
                                    window.location = '{{route("penjualan.sudah_bayar")}}';
                                }
                            }
                        });
                    }
                })
            })
        })
     
    </script>
@endsection
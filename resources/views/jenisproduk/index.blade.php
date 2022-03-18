@extends('template')
@section('title')
    Jenis Produk
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
                        <h4 class="mb-0 font-size-18">Jenis Produk</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Jenis Produk</li>
                        </ol>
                    </div>
                    <div class="state-informatio d-sm-block">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Tambah</button>
                        
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
                            <h4 class="card-title">Jenis Produk</h4>
                            <div class="table-responsive mt-4">
                                <table id="datatable-server" class="table table-bordered  nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Jenis Produk
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('jenis-produk.store')}}">
                        @csrf
                     
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"  name="nama" required>
                        </div>
                       
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    </div>
                    </form>
                </div>  
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ubah Jenis Produk
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('jenis-produk.store')}}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                      
                       
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    </div>
                    </form>
                </div>  
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script>
        
        $(function(){
            let table = $("#datatable-server").DataTable({
                processing: true,
                serverSide: true,
                scrollX:true,
                ajax: "{{ route('jenis-produk.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'is_delete', name: 'is_delete'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width: '30%'},
                ],
                columnDefs:[
                    {
                        targets: [0],
                        width: '5%',
                    }
                    
                ]
            });
            $('.status').change(function(){
                table.draw();
            });

            $(document).on('click','.edit',function(){
               
                $('.loading').removeAttr('hidden')
                var id = $(this).attr('data-id');
                url = '{{route("jenis-produk.edit",":id")}}';
                url = url.replace(':id', id);
                _token = $('input[name=_token]').val();
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: url,
                })
                .done(function(response) {
                    console.log(response)
                    $('#id').val(response.id)
                    $('#nama').val(response.nama)
                    $('#myModal2').modal('show');
                    
                })
                .fail(function(){
                    $.alert("error");
                    return;
                })
                .always(function() {
                    $('.loading').attr('hidden',true)
                    console.log("complete");
                });
            })
        })
        $(document).on('click','.btn-delete',function(){
                var id = $(this).attr('data-id')
                var url = "{{route('jenis-produk.destroy',':id')}}";
                url = url.replace(':id',id)
                _token = $('input[name=_token]').val();
                Swal.fire({
                    title: 'Apakah anda yakin ingin mengubah status data ini ?',
                    showCancelButton: true,
                    confirmButtonColor: "#35a989",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal",
                    icon:"warning",
                    preConfirm: ()=>{
                        $.ajax({
                            url: url, 
                            data: {
                                '_method':'DELETE',
                                '_token':_token
                            },
                            dataType: 'json',                         
                            type: 'post',
                            success: function(resp){
                                console.log(resp)
                                if(resp == 1){
                                    window.location = '{{route("jenis-produk.index")}}';
                                }
                            }
                        });
                    }
                })
            })
    </script>
@endsection
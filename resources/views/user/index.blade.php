@extends('template')
@section('title')
    User
@endsection
@section('css')
    
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">User</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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

                            <h4 class="card-title">List User</h4>
                         
                            <div class="table-responsive">

                                <table id="datatable-server" class="table table-bordered nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Level</th>
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
                    <h5 class="modal-title" id="myModalLabel">Tambah User
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.store')}}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"  name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" id="level2" class="form-control" required>
                                <option value="1">Admin</option>
                                <option value="2">User 1 (Unit Desa Wisata)</option>
                                <option value="3">User 2 (DTW/Homestay)</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 place" hidden>
                            <label class="form-label">Tempat Wisata</label>
                            <select name="place_id" id="place_id2" class="form-control select2">
                                <option value=""></option>
                                @foreach ($tempat as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
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
                    <h5 class="modal-title" id="myModalLabel">Ubah User
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.store')}}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="1">Admin</option>
                                <option value="2">User 1 (Unit Desa Wisata)</option>
                                <option value="3">User 2 (DTW/Homestay)</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 place2">
                            <label class="form-label">Tempat Wisata</label>
                            <select name="place_id" id="place_id" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($tempat as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a id="" href="#" class="text-blue change_password" style="width:100%">Ubah Password</a>
                        <a id="" class="text-red batal" href="#" style="width:100%" hidden>Batal Ubah Password</a>
                        <div class="formpassword">
                    
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
         let table = $("#datatable-server").DataTable({
                processing: true,
                serverSide: true,
                scrollX:true,
                ajax: "{{ route('user.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'level', name: 'level'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width: '30%'},
                ],
                columnDefs:[
                    {
                        targets: [0],
                        width: '5%',
                    }
                    
                ]
            });

         $('.change_password').click(function(){
            $('.formpassword').append(`
                        <div class="form-group mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
            `)
            $('.batal').removeAttr('hidden');
            $(this).attr('hidden',true);
            
        })
        $('.batal').click(function(){
            $('.formpassword').empty();
            $('.change_password').removeAttr('hidden');
            $(this).attr('hidden',true);
        })

        $(document).on('click','.edit',function(){
            $('.change_password').removeAttr('hidden');
            $('.batal').attr('hidden',true);
            $('.formpassword').empty()
            $('.loading').removeAttr('hidden')
            var id = $(this).attr('data-id');
            url = '{{route('user.edit',":id")}}';
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
                $('#email').val(response.email)
                $('#level').val(response.role)
                if(response.role == 3){
                    $('.place2').prop('hidden',false)
                    $('#place_id').prop('required',true)
                    $('#place_id').val(response.place_id).trigger('change')
                }else{
                    $('.place2').prop('hidden',true)
                    $('#place_id').prop('required',false)
                    $('#place_id').val('')
                }
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

        $('#level2').change(function(){
            console.log($(this).val())
            if($(this).val() == 3){
                $('.place').prop('hidden',false)
                $('#place_id2').prop('required',true)
                $('#place_id2').val('')
            }else{
                $('.place').prop('hidden',true)
                $('#place_id2').prop('required',false)
                $('#place_id2').val('')
            }
        })

        $('#level').change(function(){
            if($(this).val() == 3){
                $('.place2').prop('hidden',false)
                $('#place_id').prop('required',true)
                $('#place_id').val('')
            }else{
                $('.place2').prop('hidden',true)
                $('#place_id').prop('required',false)
                $('#place_id').val('')
            }
        })

        $(document).on('click','.btn-delete',function(){
                var id = $(this).attr('data-id')
                var url = "{{route('user.destroy',':id')}}";
                url = url.replace(':id',id)
                _token = $('input[name=_token]').val();
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data ini ?',
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
                                    window.location = '{{route("user.index")}}';
                                }
                            }
                            
                        });
                    }
                })
            })
    </script>
@endsection
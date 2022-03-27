@extends('template')
@section('title')
    Pengguna
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
                        <h4 class="mb-0 font-size-18">Pengguna</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Pengguna</li>
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
                            <h4 class="card-title">List Pengguna</h4>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <label class="form-label">Rekanan Usaha</label>
                                    <select name="tempat" id="tempat" class="form-control select2-filter-search">
                                        <option value="">Semua</option>
                                        @foreach ($tempat as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">

                                <table id="datatable-server" class="table table-bordered nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">No</th>
                                            <th class="text-center">Rekanan Usaha</th>
                                            <th class="text-center">Nama Pengguna</th>
                                            <th class="text-center">Kontak</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Level</th>
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
                    <h5 class="modal-title" id="myModalLabel">Tambah Pengguna
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.store')}}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" id="level2" class="form-control" required>
                                <option value="1">Admin</option>
                                <option value="2">User 1 (Unit Desa Wisata)</option>
                                <option value="3">User 2 (DTW/Homestay)</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 place" hidden>
                            <label class="form-label">Rekanan Usaha</label>
                            <select name="place_id" id="place_id2" class="form-control select2">
                                <option value=""></option>
                                @foreach ($tempat as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"  name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" class="form-control"  name="kontak" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control"  name="alamat" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                   
                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                            <label for="" class="text-danger error" hidden>Konfirmasi password salah</label>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect btn-submit">Simpan</button>
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
                    <h5 class="modal-title" id="myModalLabel">Ubah Pengguna
                    </h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.store')}}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label class="form-label">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="1">Admin</option>
                                <option value="2">User 1 (Unit Desa Wisata)</option>
                                <option value="3">User 2 (DTW/Homestay)</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 place2">
                            <label class="form-label">Rekanan Usaha</label>
                            <select name="place_id" id="place_id" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($tempat as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" class="form-control"  name="kontak" id="kontak" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control"  name="alamat" id="alamat" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                   
                        <a id="" href="#" class="text-blue change_password" style="width:100%">Ubah Password</a>
                        <a id="" class="text-red batal" href="#" style="width:100%" hidden>Batal Ubah Password</a>
                        <div class="formpassword">
                    
                        </div>
                       
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect btn-submit2">Simpan</button>
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
                    url: "{{ route('user.data') }}",
                    data: function (d) {
                            d.search = $('input[type="search"]').val(),
                            d.place_id = $('#tempat').val()
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'tempat', name: 'tempat'},
                    {data: 'nama', name: 'nama'},
                    {data: 'kontak', name: 'kontak'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'email', name: 'email'},
                    {data: 'level', name: 'level'},
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

            $('#tempat').change(function(){
                table.draw();
            });

        function checkPass(a, b, type){
            if(type == 1){
                if(a == b){
                    $('.btn-submit').prop('disabled', false)
                    $('.error').prop('hidden', true)
                }else{
                    $('.btn-submit').prop('disabled', true)
                    $('.error').prop('hidden', false)
                }
            }else{
                if(a == b){
                    $('.btn-submit2').prop('disabled', false)
                    $('.error2').prop('hidden', true)
                }else{
                    $('.btn-submit2').prop('disabled', true)
                    $('.error2').prop('hidden', false)
                }
            }
        }

        $(document).on('keyup','#password',function(){
            if($('#konfirmasi_password').val() != ''){
                checkPass($('#password').val(), $('#konfirmasi_password').val(), 1)
            }
        })

        $(document).on('keyup','#konfirmasi_password',function(){
            checkPass($('#password').val(), $('#konfirmasi_password').val(), 1)
        })

        $(document).on('keyup','#password2',function(){
            if($('#konfirmasi_password2').val() != ''){
                checkPass($('#password2').val(), $('#konfirmasi_password2').val(), 2)
            }
        })

        $(document).on('keyup','#konfirmasi_password2',function(){
            checkPass($('#password2').val(), $('#konfirmasi_password2').val(), 2)
        })



         $('.change_password').click(function(){
            $('.formpassword').append(`
                        <div class="form-group mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password2" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password2" name="konfirmasi_password" required>
                            <label for="" class="text-danger error2" hidden>Konfirmasi password salah</label>
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
                $('#kontak').val(response.kontak)
                $('#alamat').val(response.alamat)
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
                                    window.location = '{{route("user.index")}}';
                                }
                            }
                            
                        });
                    }
                })
            })
    </script>
@endsection
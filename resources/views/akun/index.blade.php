@extends('template')
@section('title')
    Akun
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
                        <h4 class="mb-0 font-size-18">Akun</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Akun</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Page-content-Wrapper -->
        <div class="page-content-wrapper">
            <form method="post" action="{{route('akun.store')}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Akun</h4>
                            @csrf
                            <div class="row">
                                
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{$data->nama}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control amount" value="{{$data->email}}">
                                    </div>
                                    <a id="" href="#" class="text-success change_password" style="width:100%">Ubah Password</a>
                                    <a id="" class="text-danger batal" href="#" style="width:100%" hidden>Batal Ubah Password</a>
                                    <br>
                                    <br>
                                    <div class="formpassword">
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect btn-submit">Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </form>
            <!-- end row -->

        </div>
        <!-- End Page-content -->
    </div>
   
@endsection

@section('js')
    <script>
        
        $(function(){
            
            $('form').submit(function() {
                $('.loading').removeAttr('hidden')
            });
            $('.change_password').click(function(){
                $('.formpassword').append(`
                            <div class="form-group mb-3">
                                <label class="form-label">Password </label>
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
        })
       
    </script>
@endsection
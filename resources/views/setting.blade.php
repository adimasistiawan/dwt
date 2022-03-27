@extends('template')
@section('title')
    Pengaturan
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
                        <h4 class="mb-0 font-size-18">Pengaturan</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Pengaturan</li>
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
                            <h4 class="card-title">Pengaturan</h4>
                            <div class="col-md-4">

                                <form action="{{route('pengaturan.store')}}" id="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" >
                                        <label for="">Logo</label>
                                        <input type="file" class="mt-4 image-input dropify" data-default-file="{{asset(getSettings('logo'))}}" name="logo" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="">Manajer Unit Desa Wisata Taro</label>
                                        <input type="text" name="manager" value="{{getSettings('manager')}}" class="form-control">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="">Ketua Pokdarwis Desa Wisata Taro </label>
                                        <input type="text" name="ketua_pokdarwis" value="{{getSettings('ketua_pokdarwis')}}" class="form-control">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="">Bendahara BUMDes Sarwada Amertha</label>
                                        <input type="text" name="bendahara" value="{{getSettings('bendahara')}}" class="form-control">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="">Sekretaris BUMDes Sarwada Amerta Taro </label>
                                        <input type="text" name="sekretaris" value="{{getSettings('sekretaris')}}" class="form-control">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="">Pengawas Desa Wisata Taro </label>
                                        <input type="text" name="pengawas" value="{{getSettings('pengawas')}}" class="form-control">
                                    </div>
                              
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
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
            $('.dropify').dropify({
                messages: {
                    'default': 'Upload File',
                }
            });
        })
    </script>
@endsection
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login | Sistem Informasi Penjualan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="colored">
        <div class="account-pages"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="auth-logo">
                        <h3 class="text-center">
                            <a href="index.html" class="logo d-block mt-4">
                                <h1>Sistem Informasi Penjualan</h1>
                            </a>
                            {{-- <b style="font-size: 14px;">Exellent Notary System</b> --}}
                        </h3>
                    </div>

                    <div class="p-3">
                        {{-- <h4 class="text-muted font-size-18 text-center">Selamat Datang</h4> --}}
                        <p class="text-muted text-center">Masuk untuk mendapatkan akses</p>

                        <form class="form-horizontal" action="{{route('login.submit')}}" method="POST">
                            @csrf
                            @if(session('error'))
                            <div class="alert alert-danger">Email atau Password Salah</div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Password</label>
                                <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                            </div>

                            <div class="mb-3 row">
                               
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary w-md waves-effect waves-light w-100" type="submit">Log In</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

            <div class="text-center">
                <p class="text-muted">
                    ©
                    <script>document.write(new Date().getFullYear())</script> Unit Desa Wisata Taro. 
                </p>
            </div>

        </div>


        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>

</html>
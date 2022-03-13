<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>@yield('title') | Sistem Informasi Penjualan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico"> --}}

        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/libs/daterangepicker/daterangepicker.min.css')}}" rel="stylesheet">
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}"  rel="stylesheet" type="text/css" />
        {{-- <link rel="stylesheet" href="{{asset('assets/libs/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('assets/libs/jquery-confirm/css/jquery-confirm.css')}}">
        <link rel="stylesheet" href="{{asset('assets/libs/toastr/toastr.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert/sweetalert.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/libs/parsley-js/parsley.css')}}">
        <link rel="stylesheet" href="{{asset('assets/libs/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/libs/dropify/css/dropify.css') }}">
        <style>

              .select2-container .select2-selection--single {
                  height: 34px !important;
              }
              .select2-container--default .select2-selection--single .select2-selection__rendered {
                  line-height: 33px !important;
              }
              .select2{
                  width: 100% !important;
              }
              .loading {
                position: fixed;
                z-index: 999;
                height: 2em;
                width: 2em;
                overflow: visible;
                margin: auto;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
              }
              
              /* Transparent Overlay */
              .loading:before {
                content: '';
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.3);
              }
              
              /* :not(:required) hides these rules from IE9 and below */
              .loading:not(:required) {
                /* hide "loading..." text */
                font: 0/0 a;
                color: transparent;
                text-shadow: none;
                background-color: transparent;
                border: 0;
              }
              
              .loading:not(:required):after {
                content: '';
                display: block;
                font-size: 10px;
                width: 1em;
                height: 1em;
                margin-top: -0.5em;
                -webkit-animation: spinner 1500ms infinite linear;
                -moz-animation: spinner 1500ms infinite linear;
                -ms-animation: spinner 1500ms infinite linear;
                -o-animation: spinner 1500ms infinite linear;
                animation: spinner 1500ms infinite linear;
                border-radius: 0.5em;
                -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
                box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
              }
              
              /* Animation */
              
              @-webkit-keyframes spinner {
                0% {
                  -webkit-transform: rotate(0deg);
                  -moz-transform: rotate(0deg);
                  -ms-transform: rotate(0deg);
                  -o-transform: rotate(0deg);
                  transform: rotate(0deg);
                }
                100% {
                  -webkit-transform: rotate(360deg);
                  -moz-transform: rotate(360deg);
                  -ms-transform: rotate(360deg);
                  -o-transform: rotate(360deg);
                  transform: rotate(360deg);
                }
              }
              @-moz-keyframes spinner {
                0% {
                  -webkit-transform: rotate(0deg);
                  -moz-transform: rotate(0deg);
                  -ms-transform: rotate(0deg);
                  -o-transform: rotate(0deg);
                  transform: rotate(0deg);
                }
                100% {
                  -webkit-transform: rotate(360deg);
                  -moz-transform: rotate(360deg);
                  -ms-transform: rotate(360deg);
                  -o-transform: rotate(360deg);
                  transform: rotate(360deg);
                }
              }
              @-o-keyframes spinner {
                0% {
                  -webkit-transform: rotate(0deg);
                  -moz-transform: rotate(0deg);
                  -ms-transform: rotate(0deg);
                  -o-transform: rotate(0deg);
                  transform: rotate(0deg);
                }
                100% {
                  -webkit-transform: rotate(360deg);
                  -moz-transform: rotate(360deg);
                  -ms-transform: rotate(360deg);
                  -o-transform: rotate(360deg);
                  transform: rotate(360deg);
                }
              }
              @keyframes spinner {
                0% {
                  -webkit-transform: rotate(0deg);
                  -moz-transform: rotate(0deg);
                  -ms-transform: rotate(0deg);
                  -o-transform: rotate(0deg);
                  transform: rotate(0deg);
                }
                100% {
                  -webkit-transform: rotate(360deg);
                  -moz-transform: rotate(360deg);
                  -ms-transform: rotate(360deg);
                  -o-transform: rotate(360deg);
                  transform: rotate(360deg);
                }
              }
            
              .readed{
                  background: #f1f1f1 !important;
              }
              .text-right{
                text-align: right;
              }
              .text-yellow{
                  color: #f5b22 !important;
              }
            </style>
        @yield('css')
    </head>

    <body data-topbar="colored">
        
        <div id="layout-wrapper">
            <div class="loading" hidden>Loading&#8230;</div>
            <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark mt-4">
                    <span class="logo-sm">
                        <h2>SIP</h2>
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset(getSettings('logo'))}}" width="200px" height="80px" alt="">
                    </span>
                </a>

                <a href="#" class="logo logo-light mt-4">
                    <span class="logo-sm">
                        <h4>SIP</h4>
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset(getSettings('logo'))}}" width="200px" height="80px" alt="">
                    </span>
                </a>
            </div>

            <!-- Menu Icon -->

            <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>


          
        </div>

        <div class="d-flex">
           
           
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('user.png')}}"
                        alt="Header Avatar">
                        <b>{{Auth::user()->nama}}</b>
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('akun.index')}}"><i
                        class="mdi mdi-account-circle font-size-16 align-middle me-2 text-muted"></i>
                    <span>Akun</span></a>
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-primary" href="{{route('logout')}}"><i
                            class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                        <span>Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">
                   

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="{{route('dashboard')}}" class="waves-effect">
                                    <i class="mdi mdi-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="@if(Auth::user()->role == 2) javascript: void(0); @else {{route('penjualan.index')}} @endif " class="waves-effect @if(Auth::user()->role == 2) block-page @endif">
                                    <i class="mdi mdi-sale"></i>
                                    <span>Penjualan</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-book-edit"></i>
                                    <span>Laporan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="@if(Auth::user()->role == 3) javascript: void(0); @else {{route('report.produk')}} @endif" class="waves-effect @if(Auth::user()->role == 3) block-page @endif">Produk</a></li>
                                    <li><a href="@if(Auth::user()->role == 3) javascript: void(0); @else {{route('report.invoice')}} @endif" class="waves-effect @if(Auth::user()->role == 3) block-page @endif">Invoice</a></li>
                                    <li><a href="@if(Auth::user()->role == 3) javascript: void(0); @else {{route('report.perkiraan_pendapatan')}} @endif" class="waves-effect @if(Auth::user()->role == 3) block-page @endif">Perkiraan Pendapatan</a></li>
                                    <li><a href="@if(Auth::user()->role == 3) javascript: void(0); @else {{route('report.rekapitulasi_pendapatan')}} @endif" class="waves-effect @if(Auth::user()->role == 3) block-page @endif">Rekapitulasi Pendapatan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-database"></i>
                                    <span>Master Data</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a class="@if(Auth::user()->role != 1) block-page @endif" href="@if(Auth::user()->role == 1) {{route('produk.index')}}  @else javascript: void(0); @endif ">Produk</a></li>
                                    <li><a class="@if(Auth::user()->role != 1) block-page @endif" href="@if(Auth::user()->role == 1) {{route('tempat-wisata.index')}}  @else javascript: void(0); @endif">Tempat Wisata</a></li>
                                    <li><a class="@if(Auth::user()->role != 1) block-page @endif" href="@if(Auth::user()->role == 1) {{route('user.index')}}  @else javascript: void(0); @endif">User</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="@if(Auth::user()->role == 1) {{route('pengaturan')}}  @else javascript: void(0); @endif" class="waves-effect @if(Auth::user()->role != 1) block-page @endif">
                                    <i class="fa fa-cog"></i>
                                    <span>Pengaturan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <div class="main-content">

                @yield('content')
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <script>document.write(new Date().getFullYear())</script> © Unit Desa Wisata Taro | Sistem Informasi Penjualan <span
                                    class="d-none d-sm-inline-block">
                                    {{-- - Crafted with <i class="mdi mdi-heart text-primary"></i> by
                                    Themesbrand.</span> --}}
                            </div>

                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

                <!-- Settings -->
                <hr class="" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                

            </div>
            <!-- end slimscroll-menu-->
        </div>
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
        <script src="{{asset('assets/libs/select2/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('assets/libs/parsley-js/parsley.js')}}"></script>
        <script src="{{asset('assets/libs/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables/datatables.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/libs/moment/moment.js')}}"></script>
        <script src="{{asset('assets/libs/daterangepicker/daterangepicker.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery-confirm/js/jquery-confirm.js')}}"></script>
        <!-- Peity JS -->
        <script src="{{asset('assets/libs/peity/jquery.peity.min.js')}}"></script>

        <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
        <script src="{{ asset('assets/libs/dropify/js/dropify.js') }}"></script>
        
        <!-- Dashboard init JS -->
        <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script>
            $(function () {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 2000
              });
             
              $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
              $.ajaxSetup({
                  complete: function(){
                      $("[data-toggle='tooltip']").tooltip({
                          trigger: 'hover'
                      });
                  }
              })
              $("[data-toggle='tooltip']").tooltip();
          
              
              $('.select2').select2({
                placeholder: "Pilih",
                minimumResultsForSearch: -1
              })

              $('.select2-search').select2({
                placeholder: "Pilih",
              })

              $('.select2-filter-search').select2({

              })
              $('.select2-filter').select2({
                minimumResultsForSearch: -1
              })
             @if(session()->has('success'))
                    toastr.success("{{session('success')}}")
             @endif

             @if(session()->has('error'))
                 $.alert("{{session('error')}}")
             @endif
              $('#datatable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
              })
              $("#datatable_length select").addClass("form-select form-select-sm")
          
              $('#datatable2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : true
              })

              $('.block-page').click(function(){
                Swal.fire({
                    title: 'Anda tidak memiliki akses ke menu ini',
                    showCancelButton: false,
                    confirmButtonColor: "#35a989",
                    confirmButtonText: "Oke",
                    icon:"warning",
                   
                })
              })

             
            })
          </script>
        @yield('js')
    </body>

</html>
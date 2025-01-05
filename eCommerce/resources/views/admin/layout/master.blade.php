<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom styles for this template-->
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Code Lab Studio</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin#home') ? 'active' : '' }}" href="{{ route('admin#home') }}">
                    <i class="fas fa-fw fa-table"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('category#list') ? 'active' : '' }}" href="{{ route('category#list') }}">
                    <i class="fa-solid fa-circle-plus"></i><span>Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('product#list')}}"><i class="fa-solid fa-layer-group"></i><span>Product Details </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('product#form')}}"><i class="fa-solid fa-plus"></i></i><span>Add Item </span></a>
            </li>

            @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{route('payment#list')}}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
            </li>
            @endif


            <li class="nav-item">
                <a class="nav-link" href="{{route('admin#sale')}}"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('adminorder#list')}}"><i class="fa-solid fa-cart-shopping"></i><span>Order Board </span></a>
            </li>

            <li class="nav-item">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                   <span class="nav-link" href="#"> <button class="" style="background-color:transparent;border:none;color:rgba(255, 255, 255, 0.942);"><i class="fa-solid fa-right-from-bracket"></i></i>Logout </button></span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset(Auth::user()->profile != null ? 'image/'.Auth::user()->profile : 'admin/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('account')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{route('admin#jr')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Add Admin
                                </a>
                                @endif

                                <a class="dropdown-item" href="{{route('password')}}">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    {{-- <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                       <span>
                                            <button class="" style="background-color:transparent;border:none;color:rgba(112, 112, 112, 0.942);"><i class="fa-solid fa-right-from-bracket"></i>
                                            Logout
                                            </button>

                                       </span>
                                    </form> --}}
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                       <span> <button class="" style="background-color:transparent;border:none;color:rgba(112, 112, 112, 0.942);"><i class="fa-solid fa-right-from-bracket"></i></i>Logout </button></span>
                                    </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('content')




    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>
    @yield('contentJs')


</body>

</html>

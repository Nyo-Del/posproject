<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                <a class="nav-link" href="{{ route('adminHome') }}"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('category#list') }}"><i class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('Product#create') }}"><i class="fa-solid fa-plus"></i></i><span>Add Item </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('P#page') }}"><i class="fa-solid fa-layer-group"></i><span>Product Details </span></a>
            </li>



             @if (Auth::user()->role == 'superadmin')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('page') }}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
              </li>
             @endif

             <li class="nav-item">
                <a class="nav-link" href="{{route('O#order')}}"><i class="fa-solid fa-bars"></i><span>Order Table</span></a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="{{ route('changepassword') }}"><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a>
            </li>

            <li class="nav-item">
              <form action="{{ route('logout') }}" method="post">
                @csrf
                    <button type="submit" class="btn bg-primary shadow-lg text-white mx-4"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>

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
                                    src="{{asset( Auth::user()->profile == null ?'admin/img/undraw_profile.svg' : 'profile/'.Auth::user()->profile )}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                @if (Auth::user()->role == 'superadmin')

                                <a class="dropdown-item" href="{{ route('addnew') }}">
                                    <i class="fa-solid fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Add New Admin
                                </a>
                                <a class="dropdown-item" href="{{ route('admin#list') }}">
                                    <i class="fa-solid fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin List
                                </a>
                                <a class="dropdown-item" href="{{ route('user#list') }} ">
                                    <i class="fa-solid fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

                                    User List
                                </a>

                                @endif


                                <a class="dropdown-item" href="{{ route('changepassword') }}">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                      <button class="btn text-secoundry"><i class="fa-solid fa-right-from-bracket "></i><small class="mx-1">Logout</small></button>


                                       </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                    @yield('admincontent')
                    @include('sweetalert::alert')





    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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



    <script>
        function loadFile(event){
         var reader = new FileReader();

          reader.onload = function (){
                 var output = document.getElementById("output");
                 output.src = reader.result;

          }
             reader.readAsDataURL(event.target.files[0]);
        }
     </script>

    <!-- Bootstrap core JavaScript-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('scriptSource')
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->


</body>

</html>

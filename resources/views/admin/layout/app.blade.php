<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Tổng quan</title>
      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset("") }}/adm/images/logo.jpg" />
      <!-- Custom fonts for this template-->
      <link href="{{ asset("") }}adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="{{ asset("") }}adm/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{ asset("") }}adm/css/sb-admin.css" rel="stylesheet">
      <link href="{{ asset("") }}adm/css/admin.css" rel="stylesheet">
   </head>
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
         <a class="navbar-brand mr-1" href="index.html">Mỹ Phẩm YouT</a>
         <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
         <i class="fas fa-bars"></i>
         </button>
         <!-- Navbar Search -->
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
               <span >Chào <b>{{ Auth::guard('admin')->user()->name }}</b></span> |
               <a class="text-white nounderline" href="#" data-toggle="modal" data-target="#logoutModal">Thoát</a>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->

         @include("admin.layout.sidebarMenu")

         @yield('content')

         <!-- /.content-wrapper -->
         <!-- /.container-fluid -->
         <!-- Sticky Footer -->
         <footer class="sticky-footer">
            <div class="container my-auto">
               <div class="copyright text-center my-auto">
                  <span>Copyright © Thầy Lộc 2017</span>
               </div>
            </div>
         </footer>
      </div>
      <!-- /.content-wrapper -->
      </div>
      <!-- /#wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bạn muốn thoát?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                  <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Thoát</button>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset("") }}adm/vendor/jquery/jquery.min.js"></script>
      <script src="{{ asset("") }}adm/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="{{ asset("") }}adm/vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="{{ asset("") }}adm/vendor/datatables/jquery.dataTables.js"></script>
      <script src="{{ asset("") }}adm/vendor/datatables/dataTables.bootstrap4.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset("") }}adm/js/sb-admin.min.js"></script>
      <!-- Demo scripts for this page-->
      <script src="{{ asset("") }}adm/js/demo/datatables-demo.js"></script>
      <script src="{{ asset("") }}adm/js/admin.js"></script>
   </body>
</html>

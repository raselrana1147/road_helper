<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/backend/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/toastr/toastr.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/backend/style/css/dropify.css')}}">
   <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/backend/dist/css/adminlte.min.css')}}">
   @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts.admin.inc.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <a href="{{ route('admin.dashboard') }}" class="brand-link">
     <img src="{{asset('assets/backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Road Helper</span>
   </a>

    <!-- Sidebar -->
      @include('layouts.admin.inc.sidebar');
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          @yield('breadcrumb')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
          @section('main')
          @show
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.admin.inc.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/backend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/backend/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/backend/dist/js/pages/dashboard.js')}}"></script>
{{-- my scrypt --}}
<script src="{{asset('assets/backend/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/backend/style/js/sweet.js')}}"></script>
<script src="{{asset('assets/backend/style/js/dropify.js')}}"></script>
<script src="{{asset('assets/backend/style/js/dropify.more.js')}}"></script>
<script src="{{asset('assets/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/jszip/jszip.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/pdfmake/pdfmake.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/backend/dist/js/adminlte.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{asset('assets/backend/style/js/custom.js')}}"></script>


<script>
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
</script>

  <script>// toster
      @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
               break;
        }
      @endif
</script>
 @yield('js')

</body>
</html>

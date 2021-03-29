<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/logo_faucet.jpg')}}">
    <title>پنل مدیریت | داشبورد اول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker-bs3.css')}}">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset('/dist/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/persianDatepicker-default.css')}}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset('/dist/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/scrole.css')}}">
    @yield('style')
    <style>
        @media print {
            .card-footer{
                background-color: #fff !important;
            }
            .content-wrapper {
                background: #fff !important;
            }
            .main-footer{
                display: none;
            }
            .btn-info{
                display: none;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper" id="app">


        <!-- Navbar -->
    @include('admin.layouts.navbar')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('admin.layouts.sidebar')


    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <a href="https://www.auwssc.gov.af">شرکت آبرسانی و کانالیزاسیون شهری افغانستان</a>
            <p target="_blank" style="float:left;">Powered by <a href="https://www.everesteagleeyed.com">Everest Eagle Eyed</a></p>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


<!-- ./wrapper -->
    <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @include('sweet::alert')
<script src="{{asset('/js/persianDatepicker.min.js')}}"></script>


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<!-- FastClick -->
<!-- AdminLTE App -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

{{--<script src="{{asset('js/main.js')}}"></script>--}}

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- page script -->
@yield('script')
@yield('calculate_customer')
@yield('date_picker')

</body>
</html>

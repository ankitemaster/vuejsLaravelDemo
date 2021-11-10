<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
        <meta name="description" content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
        <meta name="robots" content="noindex,nofollow">
        <title>Ample Admin Lite Template by WrapPixel</title>
        <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('plugins/images/favicon.png') }}">
        <!-- Custom CSS -->
        <link href="{{ url('plugins/bower_components/chartist/dist/chartist.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}">
        <!-- Custom CSS -->
        <link href="{{ url('css/style.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

            <div id="app">
                @yield('content')
            </div>

            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="{{ url('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ url('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('js/app-style-switcher.js') }}"></script>
        <script src="{{ url('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ url('js/waves.js') }}"></script>
        <!--Menu sidebar -->
        <script src="{{ url('js/sidebarmenu.js') }}"></script>
        <!--Custom JavaScript -->
        <script src="{{ url('js/custom.js') }}"></script>
        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="{{ url('plugins/bower_components/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ url('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
        <script src="{{ url('js/pages/dashboards/dashboard1.js') }}"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    </body>
</html>

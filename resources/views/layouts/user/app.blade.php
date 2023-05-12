<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main Header -->
            @include('partials.header')

            <!-- Left side column. contains the logo and sidebar -->
            @include('partials.sidebar')
            <!-- Content Wrapper. Contains page content -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('content-header')
                </section>

                <!-- Main content -->
                <section class="content container-fluid">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <div class="control-sidebar-bg"></div>
            @include('partials.footer')
        </div>

        @include('partials.javascripts')
    </body>
</html>
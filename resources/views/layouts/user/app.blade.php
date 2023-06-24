<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
           /* Cookie Consent Popup */
            .cookie-consent {
                position: fixed;
                bottom: 20px;
                left: 20px;
                right: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                padding: 20px;
                text-align: center;
                z-index: 9999;
            }

            .cookie-consent p {
                margin-bottom: 10px;
                color: #333;
                font-size: 16px;
            }

            .cookie-consent .cookie-consent-btn {
                display: inline-block;
                padding: 10px 20px;
                border: none;
                background-color: #007bff;
                color: #fff;
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                text-transform: uppercase;
                text-decoration: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .cookie-consent .cookie-consent-btn:hover {
                background-color: #0056b3;
            }
        </style>
        @yield('css')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main Header -->
            @include('partials.header')
            @include('cookieConsent::index')
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
                @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            
            <div class="control-sidebar-bg"></div>
            @include('partials.footer')
        </div>

        @include('partials.javascripts')
        @yield('script')
    </body>
</html>
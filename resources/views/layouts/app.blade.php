<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('partials.head')
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
    </head>

    <body>
        @include('cookieConsent::index')
        <div id="app" class="wrapper">
            <nav class="navbar navbar-expand-md ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </nav>
            @include('partials.sidebar')
            <main class="content-wrapper">
                <section class="content container-fluid">
                    @yield('content')
                </section>
            </main>
        </div>
            
        @include('partials.javascripts')

    </body>

</html>

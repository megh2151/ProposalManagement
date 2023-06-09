<header>
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-menu">
            @guest
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/about-us">About US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact-us">Contact</a>
                    </li>
                    @if($show_activity_summary)
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{route('user.activitySummary')}}">Activity Summary</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('board-member')}}">Our Advisory board members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('join-board')}}">Apply to Join the Advisory board </a>
                    </li>
                    <li class="nav-item dropdown dmenu">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Legal
                        </a>
                        <div class="dropdown-menu sm-menu">
                            <a class="dropdown-item" href="/faq">FAQs</a>
                            <a class="dropdown-item" href="/privacy-policy">Privacy Policy</a>
                            <a class="dropdown-item" href="/terms-of-use">Terms of Use</a>
                        </div>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('user.dashboard')}}">Dashboard</a>
                    </li>
                    
                </ul>
            @endguest
        </div>

        <ul class="navbar-nav justify-content-end mobile-nav">
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
            @else
                <li class="dropdown user-info">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('storage/profiles/default_user.jpg') }}" alt="User Image" width="50">
                        <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-footer">
                            <a class="nav-link logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    </ul>
                </li>
        @endguest
        </ul>
    </nav>
</header>
<aside class="sidebar">
    <div class="menu">
        <ul class="nav flex-column top-nav">
            <li class="nav-item {{ request()->is('login') ? 'd-block' : 'd-none'}}">
                <a class="nav-link" href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item {{ request()->is('register') ? 'd-block' : 'd-none'}}">
                <a class="nav-link" href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item {{ request()->is('user/home') ? 'd-block' : 'd-none'}}">
                <a class="nav-link" href="#"><img src="{{asset('user/images/dashboard-icon.png')}}" /></a>
            </li>
        </ul>
                
        <ul class="nav flex-column social-nav">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.facebook.com/LetterToAsorock" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
</aside>
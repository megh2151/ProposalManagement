@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="card form-card">
        <div class="row justify-content-center">
            <div class="col-md-6 left-col">
                <div class="bg-overlay">
                    <a class="brand" href="#">Send Proposal to Asorock</a>
                    <div class="brand-name">
                        <h1>Proposal<br />Management<br><span>Platform</span></h1>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <p>We created Letter to AsoRock in response to the president's appeal for mindset change and patriotism during his campaign. He challenged us to ask what we can do for our country.</p>
                                <a href="/about-us"><button class="btn btn-readmore">Read More<i class="fa fa-chevron-circle-right ml-3" aria-hidden="true"></i></button></a>
                            </div>
                            <div class="carousel-item">
                                <p>The citizens have valuable ideas that can improve Nigeria but may face barriers in accessing government agencies that can implement them. That's why we built a portal that allows citizens to submit their ideas or proposals in a transparent and efficient way, bypassing the bureaucratic process.</p>
                            </div>
                            <div class="carousel-item">
                                <p>This way, we can connect with the government and bring positive change to our country. Please spread the word on social media and with your friends.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 right-col">
                <h3>Login</h3>
                <form method="POST" action="{{ route('login') }}" class="d-md-flex align-items-center h-100 mt-0 justify-content-center">
                    @csrf
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-submit">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

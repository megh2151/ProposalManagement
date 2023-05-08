@extends('layouts.user.app')

@section('content')
<div class="container landing-page">
    <div class="card form-card">
        <div class="row justify-content-center">
            <div class="col-md-6 left-col">
                <div class="bg-overlay">
                    <a class="brand" href="#">Logo</a>
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
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <button class="btn btn-readmore">Read More<i class="fa fa-chevron-circle-right ml-3" aria-hidden="true"></i></button>
                            </div>
                            <div class="carousel-item">
                                <p> It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                            </div>
                            <div class="carousel-item">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
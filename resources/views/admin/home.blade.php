@extends('layouts.admin.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<style>
    .star-rating {
    display: inline-flex;
    flex-direction: row-reverse;
    font-size: 16px;
    line-height: 1;
}

.star-rating .star {
    color: #ddd;
    cursor: pointer;
}

.star-rating .filled {
    color: gold;
}
    </style>
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Dashboard</h1>
    </div>
    <div class="container p-0 ">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-success">
                    <div class="card-body">
                        <a href="{{route('admin.proposal.index')}}">
                            <h2 class="mb-1">{{$proposal_count}}</h2>
                            <p>Total Proposals</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-info">
                    <div class="card-body">
                        <a href="{{route('admin.proposal.users')}}">
                            <h2 class="mb-1">{{$user_count}}</h2>
                            <p>Total Users</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-warning">
                    <div class="card-body">
                        <a href="{{route('admin.users')}}">
                            <h2 class="mb-1">{{$gov_count}}</h2>
                            <p>Total Gov Users</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-primary">
                    <div class="card-body">
                        <a href="{{route('admin.categories')}}">
                            <h2 class="mb-1">{{$cat_count}}</h2>
                            <p> Total Categories</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Proposals</h2>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table id="basic-data-table" class="table nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Submitted Date</th>
                                    <th>No. of times viewed</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proposals as $proposal)
                                    <tr>
                                        <td><a href="{{route('admin.proposal.index')}}">{{ $proposal->title }}</a></td>
                                        <td>{{ date('jS M Y h:i A',strtotime($proposal->created_at->toDateTimeString())) }}</td>
                                        <td>{{ $proposal->no_of_times_viewed ? $proposal->no_of_times_viewed : 0 }}</td>
                                        <td>
                                        <div class="star-rating" >
                                            @for ($i = 5; $i >= 1; $i--)
                                                <span class="star {{ $proposal->rating >= $i ? 'filled' : 'empty' }}"><i class="fas fa-star"></i></span>
                                            @endfor
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
 @endsection
 @section('script')
 <script>
  
</script>
@endsection
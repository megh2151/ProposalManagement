@extends('layouts.user.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>{{$proposal->title}} Preview</h2>
    </div>
    <div class="row">
        {!! $proposal->description !!}
    </div>
</div>

@endsection
@extends('layouts.admin.master')

@section('content')
<div class="breadcrumb-wrapper">
    <h1>{{$proposal->title}} Preview</h1>
</div>
<div class="container">
    <div class="row">
        {!! $proposal->description !!}
    </div>
</div>

@endsection
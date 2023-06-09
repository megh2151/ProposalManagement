@extends('layouts.admin.master')

@section('css')
<style>
    .breadcrumb-wrapper {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .title-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-grow: 1;
    }

    .download-button {
        margin-left: 10px; /* Adjust the spacing as needed */
    }
</style>
@endsection
@section('content')
<div class="breadcrumb-wrapper">
    <div class="title-container">
        <h1>{{$proposal->title}} Preview</h1>
        @if($proposal->file_path)
            <a href="{{$url}}" class="download-button btn btn-primary">Preview</a>
        @endif
    </div>
</div>
<div class="container">
    <div class="row">
        {!! $proposal->description !!}
    </div>
</div>
@endsection
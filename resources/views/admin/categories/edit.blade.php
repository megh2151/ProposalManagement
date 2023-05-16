@extends('layouts.admin.master')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Edit Category</h1>
    </div>

    <div class="card category-card">
        <div class="card-header">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.category.update') }}" enctype="multipart/form-data"
                data-parsley-validate id="edit-category">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                <div class="row m-0 justify-content-center">
				    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Enter Name" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark mb-2 font-weight-medium d-inline-block" for="">Status</label>
                            <ul class="list-unstyled list-inline">
                                <li class="d-inline-block mr-3">
                                    <label class="control control-radio">Active
                                        <input type="radio" name="status" value="1" {{$category->is_active ? 'checked' : ''}}>
                                        <div class="control-indicator"></div>
                                    </label>
                                </li>
                                <li class="d-inline-block mr-3">
                                    <label class="control control-radio">In Active
                                        <input type="radio" name="status" value="0" {{$category->is_active ? '' : 'checked'}}>
                                        <div class="control-indicator"></div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-footer pt-4 mt-4 text-center">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $('#edit-category').parsley();
    </script>
@endsection

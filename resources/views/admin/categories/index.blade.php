@extends('layouts.admin.master')

@section('content')
    <div class="breadcrumb-wrapper">
        <div class="row align-items-center">
            <div class="col-8">
                <h1>Categories</h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{ route('admin.category.create') }}" class="btn add-btn">
                    <i class=" mdi mdi-plus-circle mr-1"></i> Add Category
                </a>
            </div>
        </div>
    </div>

    <div class="card category-card">
        <div class="card-body">
            <div class="basic-data-table">
                <table id="basic-data-table" class="table nowrap" data-order='[[ 2, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->is_active ? 'Active' : 'InActive' }}</td>
                                <td>{{ date('Y-m-d h:i:s A',strtotime($category->created_at->toDateTimeString())) }}</td>
                                <td>
                                    <a href="{{ route('admin.subcategory.index', ['id' => $category->id]) }}"><button class="rounded-pill btn-warning mr-2">Sub Categories</button></a> 
                                    <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"><button class="rounded-btn btn-success mr-2"><i class="mdi mdi-pencil"></i></button></a>
                                    <a href="javascript:void(0);" class="delete-category"
                                        data-categoryId="{{ $category->id }}"><button class="rounded-btn btn-danger"><i class="mdi mdi-delete"></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.category.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id" value="">
                        <button type="button" class="btn btn-primary btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-pill">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-category", function() {
                var catId = $(this).attr('data-categoryId');
                var thisObj = $(this);
                $("#cat_id").val(catId);
                $("#exampleModal").modal('show');
            });
        });
    </script>
@endsection

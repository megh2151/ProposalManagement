@extends('layouts.admin.master')

@section('content')
    <div class="breadcrumb-wrapper">
        <div class="row align-items-center">
            <div class="col-8">
                <h1>Sub Categories <span>{{$category->name}}</span></h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{ route('admin.subcategory.create',['id'=>$id]) }}" class="btn add-btn">
                    <i class="mdi mdi-plus-circle mr-1"></i> Add Sub Category
                </a>
            </div>
        </div>
    </div>

    <div class="card card-subcategory">
        <div class="card-body">
            <div class="basic-data-table">
                <table id="basic-data-table" class="table nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->name }}</td>
                                <td>{{ $subcategory->category->name }}</td>
                                <td>{{ $subcategory->is_active ? 'Active' : 'InActive' }}</td>
                                </td>
                                <td>
                                    <a href="{{ route('admin.subcategory.edit', ['id' => $id, 'subid'=>$subcategory->id]) }}"><button class="rounded-btn btn-success mr-2"><i class="mdi mdi-pencil"></i></button></a>
                                    <a href="javascript:void(0);" class="delete-subcategory"
                                        data-subcategoryId="{{ $subcategory->id }}"><button class="rounded-btn btn-danger"><i class="mdi mdi-delete"></i></button></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this sub category?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.subcategory.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="subcat_id" id="subcat_id" value="">
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
            $(document).on("click", ".delete-subcategory", function() {
                var subcatId = $(this).attr('data-subcategoryId');
                var thisObj = $(this);
                $("#subcat_id").val(subcatId);
                $("#exampleModal").modal('show');
            });
        });
    </script>
@endsection

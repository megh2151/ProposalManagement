@extends('layouts.admin.master')

@section('content')
    <div class="breadcrumb-wrapper">
        <div class="row align-items-center">
            <div class="col-8">
                <h1>Users</h1>
            </div>
        </div>
    </div>

    <div class="card user-card">
        <div class="card-body">
            <div class="basic-data-table">
                <table id="basic-data-table" class="table nowrap">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td> <img class="rounded-circle" src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('storage/profiles/default_user.jpg') }}" alt="{{ $user->name }}" width="40" height="40"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->middle_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->location }}</td>
                                <td>{{ $user->phone }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.users.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="">
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
            $(document).on("click", ".delete-user", function() {
                var userId = $(this).attr('data-userId');
                var thisObj = $(this);
                $("#user_id").val(userId);
                $("#exampleModal").modal('show');
            });
        });
    </script>
@endsection

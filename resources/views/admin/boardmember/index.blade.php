@extends('layouts.admin.master')

@section('content')
    <div class="breadcrumb-wrapper">
        <div class="row align-items-center">
            <div class="col-8">
                <h1>Board Members</h1>
            </div>
        </div>
    </div>

    <div class="card user-card">
        <div class="card-body">
            <div class="basic-data-table">
                <table id="basic-data-table" class="table"  style="width:100%" data-order='[[ 3, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Biography</th>
                            <th>Video</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $user)
                            <tr>
                                <td> <img class="rounded-circle" src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('storage/profiles/default_user.jpg') }}" alt="{{ $user->name }}" width="40" height="40"></td>
                                <td>{{ $user->designation }} {{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->biography)<a href="javascript:void(0);" class="view-biography" data-biography="{!!$user->biography!!}">View</a>@else - @endif</td>
                                <td>@if($user->video)<a href="javascript:void(0);" class="see-video" data-video="{{ asset($user->video) }}">View</a>@else - @endif</td>
                                <td>{{ date('Y-m-d h:i:s A',strtotime($user->created_at->toDateTimeString())) }}</td>
                                <td>
                                    <label class="switch switch-primary switch-pill form-control-label mt-1">
                                        <input type="checkbox" id="activityToggle" data-user_id="{{$user->id}}" class="switch-input form-check-input activityToggle" value="on" {{$user->is_active ? 'checked' : ''}}><span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <a href="javascript:void(0);" class="delete-user"
                                        data-userId="{{ $user->id }}">
                                        <button class="rounded-btn btn-danger"><i class="mdi mdi-delete"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userVideo" tabindex="-1" role="dialog" aria-labelledby="userVideoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userVideoLabel">Video Intro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="divVideo">
                    <video width="100%" height="100%" controls>
                        <source src="" id="source" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userBiography" tabindex="-1" role="dialog" aria-labelledby="userBiographyLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userBiographyLabel">User Biography</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="divBiography">
                    
                </div>
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
        // Get the checkbox element
        var activityToggle = $();

        // Attach a change event listener to the checkbox
        $(document).on("change", ".activityToggle", function() {
            // Get the new value of the checkbox
            var isChecked = $(this).is(':checked');
            var user_id = $(this).data('user_id')
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Make an AJAX call to update the value in the database
            $.ajax({
                url: 'update-user',  // Replace with the actual URL to update the database
                method: 'POST',
                data: { is_active : isChecked,user_id : user_id,_token: csrfToken, },  // Pass the new value to the server
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log(error);
                }
            });
        });

        $(document).on("click", ".see-video", function() {
            var videosrc = $(this).data('video');
            var $video = $('#divVideo video'),
            videoSrc = $('source', $video).attr('src', videosrc);
            $video[0].load();
            $video[0].play();
            $("#userVideo").modal('show');
        });

        $(document).on("click", ".view-biography", function() {
            var biography = $(this).data('biography');
            $('#divBiography').html(biography);
            $("#userBiography").modal('show');
        });

        $(document).on("click", ".delete-user", function() {
            var userId = $(this).attr('data-userId');
            var thisObj = $(this);
            $("#user_id").val(userId);
            $("#exampleModal").modal('show');
        });

    });
</script>    
@endsection

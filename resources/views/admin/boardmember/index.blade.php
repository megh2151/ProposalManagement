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
                <table id="basic-data-table" class="table nowrap" data-order='[[ 3, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
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
                                <td>{{ date('Y-m-d h:i:s A',strtotime($user->created_at->toDateTimeString())) }}</td>
                                <td>
                                    <div class="col-md-10">
                                        <label class="switch switch-primary switch-pill form-control-label">
                                            <input type="checkbox" id="activityToggle" data-user_id="{{$user->id}}" class="switch-input form-check-input activityToggle" value="on" {{$user->is_active ? 'checked' : ''}}><span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    alert(response.message)
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.log(error);
                }
            });
        });
    });
</script>    
@endsection

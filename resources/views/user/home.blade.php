@extends('layouts.user.app')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
@endsection
@section('content')
<div class="container p-0">
    <h2 class="mb-4">Proposal Management Platform</h2>
    <ul class="nav nav-tabs" id="dashboardTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="proposals-tab" data-toggle="tab" data-target="#proposals" type="button" role="tab" aria-controls="proposals" aria-selected="true">My Proposals</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="create-proposal-tab" data-toggle="tab" data-target="#create-proposal" type="button" role="tab" aria-controls="create-proposal" aria-selected="false">Create Proposal</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link " id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">My Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link " id="password-tab" data-toggle="tab" data-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Change Password</button>
        </li>
    </ul>
    <div class="tab-content" id="dashboardTabContent">
        <div class="tab-pane fade show active" id="proposals" role="tabpanel" aria-labelledby="proposals-tab">
            <div class="col-lg-12 p-0">
                <div class="row">
                    @if(count($proposals))
                        @foreach($proposals as $proposal)
                        <div class="col-md-4 pl-md-0">
                            <div class="card proposal-card {{$proposal->is_access_request ? 'bg-warning' : ''}}">
                                <div class="card-header row">
                                    <div class="col-8 p-0">
                                        <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>{{$proposal->title}} </h5>
                                        <strong><i class="fa fa-eye mr-2" aria-hidden="true"></i>
                                        <span>{{$proposal->no_of_times_viewed ? $proposal->no_of_times_viewed : 0}}</span></strong>
                                    </div>
                                    <div class="col-4 text-right p-0">
                                        <label>{{date('jS F Y',strtotime($proposal->created_at))}}</br>{{ucfirst($proposal->status)}}</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 pl-0">
                                            <a href="{{route('user.proposal.view',['id'=>$proposal->id])}}" title="View Proposal Uploaded" class="btn btn-primary"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-8 text-right pr-0">
<<<<<<< HEAD
                                            @if($proposal->is_access_request)
                                                <a href="javascript:void(0);" title="Grant access to Government" data-proposalid="{{$proposal->id}}" class="btn btn-dark float-right mr-2 access_request" data-accessNote="{{$proposal->access_request_note}}"><i class="fa fa-universal-access"></i></a>
                                            @endif            
                                            <a href="{{route('user.proposal.edit',['id'=>$proposal->id])}}"  title="Edit My Proposal" class="btn btn-success mr-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0);" data-proposalid="{{$proposal->id}}" title="Delete My Proposal" class="btn btn-danger mr-2 delete-proposal-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
=======
                                        
                                            @if($proposal->is_access_request)
                                                <a href="javascript:void(0);" title="Gov User Request" data-proposalid="{{$proposal->id}}" class="btn btn-dark float-right mr-2 access_request" data-accessNote="{{$proposal->access_request_note}}"><i class="fa fa-universal-access"></i></a>
                                            @endif            
                                            <a href="{{route('user.proposal.edit',['id'=>$proposal->id])}}" class="btn btn-success mr-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0);" data-proposalid="{{$proposal->id}}" class="btn btn-danger mr-2 delete-proposal-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
>>>>>>> bhagyashri
                                            @if(count($proposal->messages))
                                                 <a class="mr-2 float-right" href="{{ route('user.proposal.chat', ['id' => $proposal->id]) }}" title="Make comments" >
                                                    <button class="btn btn-warning"><i class="mdi mdi-chat"></i></button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- <p>No Proposal Found!</p>    -->
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="create-proposal" role="tabpanel" aria-labelledby="create-proposal-tab">
            <div class="row">
                <div class="col-md-5 pl-md-0">
                    <form method="POST" action="{{route('user.proposal.submit')}}" id="proposal_form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="proposal_title" class="col-form-label">{{ __('Title for Proposal:') }}</label>
                            <input id="proposal_title" maxlength="40" type="text" class="form-control @error('proposal_title') is-invalid @enderror" name="proposal_title" required>

                            @error('proposal_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-form-label">{{ __('Category:') }}</label>
                            <div class="input-group">
                                <select id="category" name="category"
                                    class="form-control @error('category') is-invalid @enderror"
                                    autocomplete="category" required>
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-id="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="subcategory" class="col-form-label">{{ __('Subcategory:') }}</label>
                            <div class="input-group" >
                                <select id="subcategory" name="subcategory"
                                    class="form-control @error('subcategory') is-invalid @enderror"
                                    autocomplete="subcategory" required>
                                    <option value="">Select a subcategory</option>
                                </select>
                            </div>
                            @error('subcategory')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

<<<<<<< HEAD
                        <div class="form-group">
                             <label for="is_gov_access" class="col-form-label">Grant Government Full access?</label>
=======
                        <div class="form-group col-md-12 p-md-0">
                             <label for="is_gov_access" class="col-form-label">Grant Government Full access</label>
>>>>>>> bhagyashri
                            </br><small class="text-danger"><i>[Note: "Yes" means the government can download your proposal and contact you. "No" means Government cannot download your proposal until you change to "Yes"]</i></small>
                            <div class="input-group" >
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="radio" name="is_gov_access" id="yesRadio" value="1" checked>
                                    <label class="form-check-label" for="yesRadio" >
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_gov_access" id="noRadio" value="0">
                                    <label class="form-check-label" for="noRadio">
                                        No
                                    </label>
                                </div>
                            </div>
                            @error('is_gov_access')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
<<<<<<< HEAD
                        <div class="form-group">
                            <label for="estimate" class="col-form-label">{{ __('Enter the estimate of implementing this proposal:') }} (Don’t worry you can change this later)</label>
                            <div class="input-group">
                                <input id="estimate" type="text" class="form-control @error('estimate') is-invalid @enderror" name="estimate" value="{{ old('estimate') }}" oninput="formatCurrency(this)" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">N</span>
                                </div>
                            </div>
                            @error('estimate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="completion_timeline" class="col-form-label">{{ __('Estimated Completion timeline:') }} (Don’t worry you can change this later)</label>
                            <select id="completion_timeline" name="completion_timeline" class="form-control @error('completion_timeline') is-invalid @enderror" required>
                                <option value="">Select completion timeline</option>
                                @for ($months = 1; $months <= 24; $months++)
                                    <option value="{{ $months }}" >{{ $months }} months</option>
                                @endfor
                            </select>
                            @error('completion_timeline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jobs_created" class="col-form-label">{{ __('Projected number of jobs to be created?') }} (Don’t worry you can change this later)</label>
                            <select id="jobs_created" name="jobs_created" class="form-control @error('jobs_created') is-invalid @enderror" required>
                                <option value="">Select projected number of jobs</option>
                                <option value="1-10" >1-10</option>
                                <option value="11-20" >11-20</option>
                                <option value="50-100" >50-100</option>
                                <option value="500-1000" >500-1000</option>
                                <option value="1001-5000" >1001-5000</option>
                                <option value="Over 5001-10000" >Over 5001-10000</option>
                            </select>
                            @error('jobs_created')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="checkbox" class="col-form-label">Select Government Level:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_federal" id="is_federal">
                                <label class="form-check-label" for="is_federal">Federal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_state" id="stateCheckbox">
                                <label class="form-check-label" for="stateCheckbox">State</label>
                            </div>
                        </div>

                        <div class="form-group" id="stateDropdown" style="display: none">
                            <label for="state" class="col-form-label">Select State:</label>
                            <select id="state" name="state" class="form-control">
                                <option value="">Select a state</option>
                                <!-- Add the options for Nigerian states here -->
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="localGovernmentDropdown" style="display: none">
                            <label for="localGovernment" class="col-form-label">Select Local Government:</label>
                            <select id="localGovernment" name="localGovernment" class="form-control">
                                <option value="">Select a local government</option>
                                <!-- The options for local governments will be dynamically populated based on the selected state -->
                            </select>
                        </div>

=======
>>>>>>> bhagyashri
                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                            <textarea id="description" row="6" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" ></textarea>
                        
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center"> OR </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('File Upload:') }}</label>
                            <input type="file" name="proposal_file" id="proposal_file"/>
                            @error('proposal_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-create">
                                {{ __('update') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-lg-5 col-md-7 pl-md-0">
                    <form method="POST" action="{{route('user.profile.update')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4 pl-md-0">
                                <label for="name" class="col-form-label">{{ __('First Name:') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{auth()->user()->name}}" required>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 p-md-0">
                                <label for="middle_name" class="col-form-label">{{ __('Middle Name:') }}</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{auth()->user()->middle_name}}" >

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 pr-md-0">
                                <label for="last_name" class="col-form-label">{{ __('Last Name:') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{auth()->user()->last_name}}" required>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-12 p-md-0">
                            <label for="email" class="col-form-label">{{ __('Email Address:') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror "  disabled name="email" value="{{auth()->user()->email}}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 p-md-0">
                            <label for="location" class="col-form-label">{{ __('Location:') }}</label>
                            <div class="input-group">
                                <select id="location" name="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    autocomplete="location">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}" data-id="{{ $country->id }}"
                                            {{ $country->name == auth()->user()->location ? 'selected' : '' }}>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 p-md-0">
                            <label for="phone" class="col-form-label">{{ __('Phone') }}</label>
                            <div class="input-group phone">
                                <div class="input-group-prepend">
                                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                                    <span class="input-group-text" id="country-code-addon">{{auth()->user()->country_code}}</span>
                                </div>
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{auth()->user()->phone}}" autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role_id" value="0">
                            <input id="country_code" type="hidden" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="{{auth()->user()->country_code}}" autocomplete="country_code">
                        </div>

                        <div class="form-group col-md-12 p-md-0">
                        <label for="profile_photo" class="col-form-label">{{ __('User Image') }}</label>
                            <div class="custom-file mb-1">
                            <input type="hidden" name="cropped_photo" id="cropped_photo">
                            <input type="file" name="profile_photo" class="custom-file-input" id="profile_photo">
                            <label class="custom-file-label" for="coverImage">Choose file...</label>
                                <div id="preview-div"  class="d-none mt-3 mb-3">
                                    <img id="photo-preview" class="mt-3 mb-3" src="" alt="Photo Preview" style="max-width: 100%; height: auto;margin-bottom:15px;">
                                    <div class="row text-center m-auto">
                                        <button id="crop-button" class="btn btn-primary text-center mt-2" disabled>Crop</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-update">
                                {{ __('update') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 col-md-5"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="row">
                <div class="col-lg-5 col-md-7 pl-md-0">
                <form method="POST" action="{{ route('user.profile.updatePassword') }}" id="changePasswordForm">
                    @csrf

                    <div class="form-group">
                        <label for="old_password">{{ __('Old Password') }}</label>
                        <input type="password" id="old_password" name="old_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{ __('New Password') }}</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">{{ __('Confirm Password') }}</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-update">{{ __('Update') }}</button>
                    </div>
                </form>

                </div>
                <div class="col-lg-7 col-md-5"></div>
            </div>
        </div>
        
    </div>
</div>
<div class="modal fade" id="sendRequest" tabindex="-1" role="dialog" aria-labelledby="sendRequestLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
<<<<<<< HEAD
                <h5 class="modal-title" id="sendRequestLabel">Gov User Request For Proposal Access </h5>
                <a href="" id="edit-proposal-btn" title="Edit My Proposal" class="btn btn-success ml-2 btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <p id="request-note"></p>
                <p>"To grant access to Government, click the green edit icon button above and change "No" to "Yes" on the edit page."</p>
=======
                <h5 class="modal-title" id="sendRequestLabel">Gov User Request For Proposal Access</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="request-note"></p>
>>>>>>> bhagyashri
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
    <script>
        
        $(document).ready(function() {
            CKEDITOR.replace('description');
            
            $('#location').on('change', function() {

                var countryId = $(this).find(':selected').data('id');
                console.log(countryId);
                var countryCode =
                    "{{ old('country_code') }}"; // Get the old value from Laravel's validation error message

                // Use an AJAX request to retrieve the phone code for the selected country
                $.ajax({
                    url: '/country/' + countryId + '/phone-code',
                    type: 'GET',
                    success: function(data) {
                        $('#country_code').val(data.phone_code);
                        $("#country-code-addon").html(data.phone_code)
                    },
                    error: function() {
                        $('#country_code').val(
                            countryCode); // If there's an error, use the old value
                        $("#country-code-addon").html(countryCode)
                    }
                });
            });

            $('#category').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: '/subcategories/' + category_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#subcategory').empty();
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty();
                }
            });

            $('#proposal_form').submit(function(e){
                e.preventDefault(); // prevent the form from submitting
                if (CKEDITOR.instances.description.getData().trim() === '' && $.trim($("#proposal_file").val()) === '') {
                    alert("Either Description or Proposal File is required.");
                } else {
                    var fileInput = $('#proposal_file');
                    if (fileInput.val()) {
                        var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
                        if (!allowedExtensions.exec(fileInput.val())) {
                            alert('Invalid file type, please select a PDF or Word document.');
                            fileInput.val('');
                            return false;
                        }
                    }
                    var editor = CKEDITOR.instances['description'];
                    // Update the instance with the current value in the textarea element
                    editor.updateElement();

                    // Create the form data object
                    var formData = new FormData(this);
                    formData.description = CKEDITOR.instances.description.getData();
                    // form submission
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success:function(data){
                            // handle success response
                            location.reload();
                        },
                        error:function(){}
                    });
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.delete-proposal-btn', function(e) {
                e.preventDefault();
                var proposalId = $(this).data('proposalid');
                if (confirm('Are you sure you want to delete this proposal?')) {
                    $.ajax({
                        url: '/proposals/' + proposalId,
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(response) {
                            $('.delete-proposal-btn[data-proposalid="' + proposalId + '"]').closest('.col-md-4').remove();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            $(document).on('click', '.access_request', function(e) {
                var accessNote = $(this).attr('data-accessNote');
<<<<<<< HEAD
                var proposalid = $(this).attr('data-proposalid');
                var url = 'proposal/'+proposalid+'/edit';
                $("#edit-proposal-btn").attr('href',url);
=======
>>>>>>> bhagyashri
                $("#request-note").text(accessNote);
                $("#sendRequest").modal('show');
            });

            $('#changePasswordForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                var oldPassword = $('#old_password').val();
                var newPassword = $('#new_password').val();
                var confirmPassword = $('#confirm_password').val();

                // Perform client-side validation
                if (oldPassword === '') {
                    alert('Please enter your old password.');
                    return false;
                }

                if (newPassword === '') {
                    alert('Please enter your new password.');
                    return false;
                }

                if (confirmPassword === '') {
                    alert('Please confirm your new password.');
                    return false;
                }

                if (newPassword !== confirmPassword) {
                    alert('New password and confirm password do not match.');
                    return false;
                }

                // If all validations pass, submit the form
                this.submit();
            });

            const photoInput = $('#profile_photo');
            const photoPreview = $('#photo-preview');
            const cropButton = $('#crop-button');
            let cropper;

            photoInput.on('change', function() {
                const file = this.files[0];
                $("#preview-div").removeClass('d-none')
                if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.attr('src', e.target.result);
                    cropButton.prop('disabled', false);
                    if (cropper) {
                    cropper.destroy();
                    }
                    cropper = new Cropper(photoPreview[0], {
                    aspectRatio: 1, // Adjust the aspect ratio as needed
                    viewMode: 1, // Set the crop box to fit within the preview container
                    autoCropArea: 0.8, // Define the initial crop area size (0-1)
                    });
                };

                reader.readAsDataURL(file);
                }
            });

            cropButton.on('click', function(event) {
                event.preventDefault(); // Prevent form submission

                const croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Specify the desired cropped image width
                height: 200, // Specify the desired cropped image height
                });

                // Convert the cropped canvas to a Blob object
                croppedCanvas.toBlob(function(blob) {
                // Preview the cropped image
                const croppedImage = new Image();
                croppedImage.src = URL.createObjectURL(blob);
                croppedImage.alt = 'Cropped Image';
                // Create a new hidden input element
                // Replace the existing photo preview with the cropped image
                photoPreview.replaceWith(croppedImage);
                $(".cropper-container").hide();
                cropButton.css('visibility', 'hidden');
                // Convert the cropped image to a data URL
                const croppedDataURL = croppedCanvas.toDataURL('image/jpeg');
                // Set the data URL as the value of the hidden input field
                $('#cropped_photo').val(croppedDataURL);

                }, 'image/jpeg'); // Specify the desired output image format

                // Reset the cropper instance and clear the preview image
                cropper.reset();
                photoPreview.attr('src', '');
            });

            $('#stateCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#stateDropdown').show();
                } else {
                    $('#stateDropdown').hide();
                    $('#localGovernmentDropdown').hide();
                }
            });
            $('#state').on('change', function() {
                var selectedState = $(this).val();
                if (selectedState !== '') {
                    // Make an AJAX request to fetch the local governments based on the selected state
                    $.ajax({
                        url: '/get-local-government-areas', // Replace with the actual URL to fetch local governments
                        method: 'GET',
                        data: { state: selectedState },
                        success: function(response) {
                            // Clear the previous options in the local government dropdown
                            $('#localGovernment').empty();
                            // Populate the local government dropdown with the received data
                            $('#localGovernment').empty();
                            $.each(response, function(key, value) {
                                var option = $('<option value="' + value.id + '">' + value.name + '</option>');
                                $('#localGovernment').append(option);
                            });

                            // Show the local government dropdown
                            $('#localGovernmentDropdown').show();
                        },
                        error: function(xhr, status, error) {
                            // Handle the error if the AJAX request fails
                            console.log(error);
                        }
                    });
                } else {
                    $('#localGovernmentDropdown').hide();
                }
            });
        });

        function formatCurrency(input) {
            // Remove non-digit characters
            let value = input.value.replace(/\D/g, '');
            
            // Format the number with commas
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            // Set the formatted value back to the input
            input.value = value;
        }
    </script>
@endsection

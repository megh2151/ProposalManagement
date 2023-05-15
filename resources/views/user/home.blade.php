@extends('layouts.user.app')

@section('content')
<div class="container p-0">
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
        
    </ul>
    <div class="tab-content" id="dashboardTabContent">
        <div class="tab-pane fade show active" id="proposals" role="tabpanel" aria-labelledby="proposals-tab">
            <div class="col-lg-10 p-0">
                <div class="row">
                    @if(count($proposals))
                        @foreach($proposals as $proposal)
                        <div class="col-md-4 pl-md-0">
                            <div class="card">
                                <div class="card-header row">
                                    <div class="col-7 p-0">
                                        <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>{{$proposal->title}}</h5>
                                    </div>
                                    <div class="col-5 text-right p-0">
                                        <label>{{date('jS F Y',strtotime($proposal->created_at))}}</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{!!$proposal->description!!}</p>
                                    @if($proposal->file_path)
                                    <a target="_blank" href="/proposals/preview/{{$proposal->file_path}}" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                                    @endif
                                    
                                    <a href="javascript:void(0);"  data-proposalid="{{$proposal->id}}" class="btn btn-danger float-right mr-2 delete-proposal-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a href="{{route('user.proposal.edit',['id'=>$proposal->id])}}"   class="btn btn-primary float-right mr-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    @if(count($proposal->messages))
                                    <a class="mr-2 float-right" href="{{ route('user.proposal.chat', ['id' => $proposal->id]) }}" >
                                        <button class="rounded-btn btn-success"><i class="mdi mdi-chat"></i></button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No Proposal Found!</p>   
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
                            <input id="proposal_title" type="text" class="form-control @error('proposal_title') is-invalid @enderror" name="proposal_title" required>

                            @error('proposal_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 p-md-0">
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
                        
                        <div class="form-group col-md-12 p-md-0">
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
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{auth()->user()->middle_name}}" required>

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
                            <label for="password" class="col-form-label">{{ __('Password:') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                            <i><small>If you want to change the password</small></i>
                            @error('password')
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
                                            {{ $country->name == 'India' ? 'selected' : '' }}>
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
                                    <span class="input-group-text" id="country-code-addon">91</span>
                                </div>
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{auth()->user()->phone}}" autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role_id" value="0">
                            <input id="country_code" type="hidden" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="91" autocomplete="country_code">
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
        
        
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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
                    url: '/countries/' + countryId + '/phone-code',
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
        });
    </script>
@endsection

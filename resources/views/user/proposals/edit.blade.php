@extends('layouts.user.app')

@section('content')
<div class="container p-0">
    <div  id="dashboardTabContent">
        <div  id="create-proposal">
            <div class="row">
                <div class="col-md-12 pl-md-0">
                    <form method="POST" action="{{route('user.proposal.update')}}" id="proposal_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="prop_id" name="prop_id" value="{{$proposal->id}}" />
                        <div class="form-group">
                            <label for="proposal_title" class="col-form-label">{{ __('Title for Proposal:') }}</label>
                            <input id="proposal_title"  type="text" maxlength="40" class="form-control @error('proposal_title') is-invalid @enderror" value="{{$proposal->title}}" name="proposal_title" required>

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
                                        <option value="{{ $category->id }}" data-id="{{ $category->id }}" {{$proposal->category_id == $category->id ? 'selected' : ''}}>
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
                        <div class="form-group ">
                            <label for="is_gov_access" class="col-form-label">Grant Government Full access?</label>
                            </br><small class="text-danger"><i>[Note: "Yes" means the government can download your proposal and contact you. "No" means Government cannot download your proposal until you change to "Yes"]</i></small>
                            <div class="input-group" >
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="radio" name="is_gov_access" id="yesRadio" value="1" {{$proposal->is_gov_access==1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="yesRadio">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_gov_access" id="noRadio" value="0" {{$proposal->is_gov_access==0 ? 'checked' : ''}}>
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
                        <div class="form-group">
                            <label for="estimate" class="col-form-label">{{ __('Enter the estimate of implementing this proposal:') }} (Don’t worry you can change this later)</label>
                            <div class="input-group">
                                <input id="estimate" type="text" class="form-control @error('estimate') is-invalid @enderror" name="estimate" value="{{ $proposal->estimate ? $proposal->estimate : old('estimate') }}" oninput="formatCurrency(this)" required>
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
                                    <option value="{{ $months }}" {{$proposal->completion_timeline == $months ? 'selected' : '' }}>{{ $months }} months</option>
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
                                <option value="1-10" {{$proposal->jobs_created == "1-10" ? 'selected' : '' }}>1-10</option>
                                <option value="11-20" {{$proposal->jobs_created == "11-20" ? 'selected' : '' }}>11-20</option>
                                <option value="50-100" {{$proposal->jobs_created == "50-100" ? 'selected' : '' }}>50-100</option>
                                <option value="500-1000" {{$proposal->jobs_created == "500-1000" ? 'selected' : '' }}>500-1000</option>
                                <option value="1001-5000" {{$proposal->jobs_created == "1001-5000" ? 'selected' : '' }}>1001-5000</option>
                                <option value="Over 5001-10000" {{$proposal->jobs_created == "Over 5001-10000" ? 'selected' : '' }}>Over 5001-10000</option>
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
                                <input class="form-check-input" type="checkbox" name="is_federal" id="is_federal" {{$proposal->is_federal ? 'checked' : 
                                ''}}>
                                <label class="form-check-label" for="is_federal">Federal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_state" id="stateCheckbox" {{$proposal->is_state ? 'checked' : ''}}>
                                <label class="form-check-label" for="stateCheckbox">State</label>
                            </div>
                        </div>

                        <div class="form-group" id="stateDropdown" style="display: {{$proposal->is_state ? 'block' : 'none'}}">
                            <label for="state" class="col-form-label">Select State:</label>
                            <select id="state" name="state" class="form-control">
                                <option value="">Select a state</option>
                                <!-- Add the options for Nigerian states here -->
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" {{$proposal->state_id ==$state->id ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="localGovernmentDropdown" style="display: {{$proposal->is_state ? 'block' : 'none'}}">
                            <label for="localGovernment" class="col-form-label">Select Local Government:</label>
                            <select id="localGovernment" name="localGovernment" class="form-control">
                                <option value="">Select a local government</option>
                                <!-- The options for local governments will be dynamically populated based on the selected state -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                            <textarea id="description" row="6" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" >{{$proposal->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center"> OR </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('File Upload:') }}</label>
                            @if($proposal->file_path)
                                <p>Uploaded File: <a target="_blank" href="/proposals/preview/{{$proposal->file_path}}">{{ $proposal->file_path }}</a></p>
                                <input type="hidden" name="existing_file" value="1">
                            @endif
                            <input type="file" name="proposal_file" id="proposal_file"/>
                            @error('proposal_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('update') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            CKEDITOR.replace('description');
            var subcategory_id = "{{ $proposal->sub_category_id }}"; //
            var local_government_area_id = "{{ $proposal->local_government_area_id }}"; //
        

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
                                var option = $('<option value="' + value.id + '">' + value.name + '</option>');
                                if (subcategory_id == value.id) { // Check if the subcategory ID matches the current iteration value
                                    option.attr('selected', 'selected'); // Set the 'selected' attribute for the matching subcategory
                                }
                                $('#subcategory').append(option);
                            });
                           
                        }
                    });
                } else {
                    $('#subcategory').empty();
                }
            });

            $('#proposal_form').submit(function(e){
                e.preventDefault(); // prevent the form from submitting

                var descriptionData = CKEDITOR.instances.description.getData().trim();
                var fileInput = $('#proposal_file');
                var filePath = $('#file_path').text();
                var existingFile = $('[name="existing_file"]').val();
                if (descriptionData === '' && !fileInput.val() && !filePath && !existingFile) {
                    alert("Either Description or Proposal File is required.");
                    return;
                } else {
                    if (!existingFile && !filePath && fileInput.val()) {
                        var file = fileInput[0].files[0];
                        var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
                        
                        if (!allowedExtensions.exec(file.name)) {
                            alert('Invalid file type, please select a PDF or Word document.');
                            fileInput.val('');
                            return;
                        }
                    }
                    var editor = CKEDITOR.instances['description'];
                    // Update the instance with the current value in the textarea element
                    editor.updateElement();

                    // Create the form data object
                    var formData = new FormData(this);
                    formData.description = CKEDITOR.instances.description.getData();
                    // form submission
                    $('#proposal_form')[0].submit();
                    // $.ajax({
                    //     url: $(this).attr('action'),
                    //     type: $(this).attr('method'),
                    //     data: formData,
                    //     contentType: false,
                    //     cache: false,
                    //     processData:false,
                    //     success:function(data){
                    //         // handle success response
                    //         location.reload();
                    //     },
                    //     error:function(){}
                    // });
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
                                if (local_government_area_id == value.id) { // Check if the government ID matches the current iteration value
                                    option.attr('selected', 'selected'); // Set the 'selected' attribute for the matching government
                                }
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

        $(window).on('load', function() {
            // Trigger the change event on window load
            $('#category').trigger('change');
            var is_state = "{{ $proposal->is_state }}"; //
            if(is_state==1){
                $('#state').trigger('change');
            }
        });
    </script>
@endsection

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
                            <input id="proposal_title" type="text" class="form-control @error('proposal_title') is-invalid @enderror" value="{{$proposal->title}}" name="proposal_title" required>

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
            var subcategory_id = "{{ $proposal->subcategory_id }}"; //

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
        });

        $(window).on('load', function() {
            // Trigger the change event on window load
            $('#category').trigger('change');
        });
    </script>
@endsection

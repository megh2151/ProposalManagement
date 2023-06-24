@extends('layouts.user.app')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
<link rel="stylesheet" href="{{ asset('admin/assets/css/parsley.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div class="card form-card">
            <div class="row justify-content-center">
                <div class="col-md-10 right-col">
                    <h3>Registration</h3>
                    <form method="POST" action="{{ route('join-board-submit') }}" data-parsley-validate enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-2 pl-lg-0">
                                <label for="name" class="col-form-label ">{{ __('Designation') }}</label>
                                <select class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" required>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Professor">Professor</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Chief">Chief</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Architect">Architect</option>
                                    <option value="Barrister">Barrister</option>
                                </select>
                            </div>
                            <div class="col-lg-3 pl-lg-0">
                                <label for="name" class="col-form-label ">{{ __('First Name') }}</label>
                                <input id="name" type="text" maxlength="15"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" autocomplete="name" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3 p-lg-0">
                                <label for="middle_name"class=" col-form-label ">{{ __('Middle Name') }}</label>
                                <input id="middle_name" type="text" maxlength="15"
                                    class="form-control @error('middle_name') is-invalid @enderror"
                                    name="middle_name" value="{{ old('middle_name') }}"
                                    autocomplete="middle_name">

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 pr-lg-0">
                                <label for="last_name" class=" col-form-label ">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" maxlength="15"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" required>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-lg-12 p-lg-0">
                            <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email"maxlength="40"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 pl-lg-0">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input id="password" type="password" maxlength="15"
                                        class="form-control password-input @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" required data-parsley-errors-container="#password-errors">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                </div>
                                <div id="password-errors"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 pr-lg-0">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" maxlength="15" class="password-input form-control"
                                        name="password_confirmation" autocomplete="new-password" required data-parsley-errors-container="#password-confirm-errors" data-parsley-equalto="#password">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                </div>
                                <div id="password-confirm-errors"></div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 p-lg-0">
                            <label for="location" class="col-form-label ">{{ __('Location') }}</label>
                            <div class="input-group">
                                <select id="location" name="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    autocomplete="location" required data-parsley-errors-container="#location-errors">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}" data-id="{{ $country->id }}">
                                            {{ $country->name }}</option> 
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div id="location-errors"></div>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12 p-lg-0">
                            <label for="phone" class="col-form-label">{{ __('Phone') }}</label>
                            <div class="input-group phone">
                                <div class="input-group-prepend">
                                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                                    <span class="input-group-text" id="country-code-addon"></span>
                                </div>
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="phone" required data-parsley-errors-container="#phone-errors">
                               
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div id="phone-errors"></div>
                            <input type="hidden" name="role_id" value="3">
                            <input id="country_code" type="hidden" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="" autocomplete="country_code">
                        </div>
                        <div class="form-group row mb-6">
                            <label for="profile_photo" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
                            <div class="col-sm-8 col-lg-10">
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
                        </div>
                        <div class="form-group row">
                            <label for="video" class="col-sm-4 col-lg-2 col-form-label">Upload Video</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="file" name="video" class="custom-file-input" id="video" accept="video/*" >
                                    <label class="custom-file-label" for="video">Choose file...</label>
                                </div>
                                <small class="form-text text-muted">Please upload a short speech video (30-60 seconds).</small>
                            </div>
                        </div>
                         <div class="form-group col-lg-12 p-lg-0">
                            <label for="email" class="col-form-label ">{{ __('Biography') }}</label>
                            <textarea id="biography" 
                                class="form-control @error('biography') is-invalid @enderror" rows="6" name="biography"
                                value="{{ old('biography') }}" autocomplete="biography" required minlength="100"></textarea>
                            @error('biography')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-submit mt-3">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
    <script src="{{ asset('admin/assets/js/parsley.min.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('biography', { toolbarLocation : 'bottom' }); 

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
            
            // Video Upload
            const videoInput = $('#video');
            videoInput.on('change', function() {
                const file = this.files[0];

                if (file) {
                    const video = document.createElement('video');
                    video.preload = 'metadata';

                    video.onloadedmetadata = function() {
                        window.URL.revokeObjectURL(video.src);
                        const duration = video.duration;
                        const minDuration = 5; // Minimum duration in seconds
                        const maxDuration = 60; // Maximum duration in seconds

                        if (duration < minDuration || duration > maxDuration) {
                            // Reset the file input
                            videoInput.val('');
                            // Show an error message to the user
                            alert('Please upload a video between 30-60 seconds in duration.');
                        }
                    };

                    video.src = URL.createObjectURL(file);
                }
            });


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

            $('.toggle-password').on('click', function() {
                var passwordInput = $(this).closest('.input-group').find('.password-input');
                var passwordFieldType = passwordInput.attr('type');
                var eyeIcon = $(this).find('i');

                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye');
                    eyeIcon.addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash');
                    eyeIcon.addClass('fa-eye');
                }
            });
        });
    </script>
@endsection

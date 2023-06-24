@extends('layouts.admin.master')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
@endsection
@section('content')
<div class="bg-white border rounded">
  <div class="row no-gutters">
    <div class="col-lg-4 col-xl-3">
      <div class="profile-content-left profile-left-spacing pt-5 pb-3 px-3 px-xl-5">
      <div class="card text-center widget-profile px-0 border-0">
        <div class="card-img mx-auto rounded-circle">
          <img src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('storage/profiles/default_user.jpg') }}" alt="User Image" style="height: 100%; object-fit: cover; border-radius: 50%;">
        </div>
        <div class="card-body">
          <h4 class="py-2 text-dark">{{$user->name}} {{$user->last_name}}</h4>
          <p>{{$user->email}}</p>
        </div>
      </div>
      </div>
    </div>

    <div class="col-lg-8 col-xl-9">
      <div class="profile-content-right profile-right-spacing py-5">
        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="true">Change Password</a>
          </li>
        </ul>

        <div class="tab-content px-3 px-xl-5" id="myTabContent">
          <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="tab-pane-content mt-5">
              <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data" id="profile_form">
                @csrf
                <div class="row mb-2">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="name">First name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="last_name">Last name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                    </div>
                  </div>
                </div>


                <div class="form-group mb-4">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" readonly name="email" value="{{$user->email}}">
                </div>
                <div class="form-group row mb-6">
                  <label for="profile_photo" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
                  <div class="col-sm-8 col-lg-10">
                    <div class="custom-file mb-1">
                    <input type="hidden" name="cropped_photo" id="cropped_photo">
                      <input type="file" name="profile_photo" class="custom-file-input" id="profile_photo" required="">
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
				<div class="row mt-5 form-group justify-content-end mb-6">
					<div class="row">
					<button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
					</div>
                </div>
              </form>
            </div>
          </div>

            <div class="tab-pane fade " id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="tab-pane-content mt-5">
                    <form id="changePasswordForm" action="{{route('admin.profile.update')}}" method="POST" >
                      @csrf
                        <input type="hidden" name="change_password" value="1" id="change_password"> 
                        <div class="form-group mb-4">
                        <label for="oldPassword">Old password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>

                        <div class="form-group mb-4">
                        <label for="newPassword">New password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password"  required>
                        </div>

                        <div class="form-group mb-4">
                        <label for="conPassword">Confirm password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
<script>
 $(document).ready(function() {
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
});
</script>
@endsection
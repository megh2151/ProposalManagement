@extends('layouts.user.app')

@section('content')
    <div class="container">
        <div class="card form-card">
            <div class="row justify-content-center">
                <div class="col-md-6 left-col">
                    <div class="bg-overlay">
                        <a class="brand" href="#">Send Proposal to Asorock</a>
                        <div class="brand-name">
                            <h1>Proposal<br />Management<br><span>Platform</span></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 right-col">
                    <h3>Registration</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-4 pl-lg-0">
                                <label for="name" class="col-form-label ">{{ __('First Name') }}</label>
                                <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 p-lg-0">
                                <label for="middle_name"class=" col-form-label ">{{ __('Middle Name') }}</label>
                                <input id="middle_name" type="text"
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
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name') }}" autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 pl-lg-0">
                                <label for="password" class="col-form-label ">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 pr-lg-0">
                                <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="location" class="col-form-label ">{{ __('Location') }}</label>
                            <div class="input-group">
                                <select id="location" name="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    autocomplete="location">
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
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="phone" class="col-form-label">{{ __('Phone') }}</label>
                            <div class="input-group phone">
                                <div class="input-group-prepend">
                                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                                    <span class="input-group-text" id="country-code-addon"></span>
                                </div>
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="role_id" value="0">
                            <input id="country_code" type="hidden" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="" autocomplete="country_code">
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
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection

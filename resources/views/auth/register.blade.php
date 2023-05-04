@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                                        <div class="col-md-7">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-4 col-form-label ">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-7">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="middle_name"
                                            class="col-md-4 col-form-label ">{{ __('Middle Name') }}</label>

                                        <div class="col-md-7">
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="last_name"
                                            class="col-md-4 col-form-label ">{{ __('Last Name') }}</label>

                                        <div class="col-md-7">
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

                                    <div class="form-group row">
                                        <label for="location" class="col-md-4 col-form-label ">{{ __('Location') }}</label>

                                        <div class="col-md-7">
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

                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label">{{ __('Phone') }}</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="country-code-addon">+91</span>
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
                                        </div>
                                    </div>

                                    <input type="hidden" name="role_id" value="0">
                                    <input id="country_code" type="hidden"
                                        class="form-control @error('country_code') is-invalid @enderror"
                                        name="country_code" value="91" autocomplete="country_code">
                                    <div class="form-group row mb-0">
                                        <div class="col-md-7 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
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

@extends('layouts.user.app')

@section('content')
<div class="container p-0">
    <ul class="nav nav-tabs" id="dashboardTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">My Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="proposals-tab" data-toggle="tab" data-target="#proposals" type="button" role="tab" aria-controls="proposals" aria-selected="true">My Proposals</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="create-proposal-tab" data-toggle="tab" data-target="#create-proposal" type="button" role="tab" aria-controls="create-proposal" aria-selected="false">Create Proposal</button>
        </li>
    </ul>
    <div class="tab-content" id="dashboardTabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-lg-5 col-md-7 pl-md-0">
                    <form method="POST">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-4 pl-md-0">
                                <label for="name" class="col-form-label">{{ __('First Name:') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 p-md-0">
                                <label for="middle_name" class="col-form-label">{{ __('Middle Name:') }}</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 pr-md-0">
                                <label for="last_name" class="col-form-label">{{ __('Last Name:') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-12 p-md-0">
                            <label for="email" class="col-form-label">{{ __('Email Address:') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 pl-md-0">
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
                            <div class="col-md-6 pr-md-0">
                                <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group col-md-12 p-md-0">
                            <label for="location" class="col-form-label">{{ __('Location:') }}</label>
                            <div class="input-group">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required>
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
                                    name="phone" value="{{ old('phone') }}" autocomplete="phone">
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
        <div class="tab-pane fade" id="proposals" role="tabpanel" aria-labelledby="proposals-tab">
            <div class="col-lg-10 p-0">
                <div class="row">
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-0">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-7 p-0">
                                    <h5><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Proposal 1</h5>
                                </div>
                                <div class="col-5 text-right p-0">
                                    <label>14th April 2023</label>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#" class="btn btn-read">Open<i class="fa fa-play-circle ml-4" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="create-proposal" role="tabpanel" aria-labelledby="create-proposal-tab">
            <div class="row">
                <div class="col-md-5 pl-md-0">
                    <form method="POST">
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
                        
                        <div class="form-group">
                            <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                            <textarea id="description" row="6" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required></textarea>
                        
                            @error('description')
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
    </div>
</div>
@endsection

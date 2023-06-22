@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Compose Email</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sendEmail') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="select-all" class="col-md-2 col-form-label text-md-right">Select Users</label>
                                <div class="col-md-10 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="prop-users" name="prop-users">
                                        <label class="form-check-label" for="prop-users">
                                            Proposal Users
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gov-users" name="gov-users">
                                        <label class="form-check-label" for="gov-users">
                                            Gov Users
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-2 col-form-label text-md-right">Select Users</label>
                                <div class="col-md-10">
                                    <select class="js-example-basic-multiple form-control" name="users[]" id="users" multiple="multiple">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->email }}">{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                    @error('users')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-md-2 col-form-label text-md-right">Subject</label>
                                <div class="col-md-10">
                                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-md-2 col-form-label text-md-right">Content</label>
                                <div class="col-md-10">
                                    <textarea id="content" class="form-control @error('content') is-invalid @enderror" rows="10" name="content" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Send Email
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
         CKEDITOR.replace('content');
        $('#gov-users').on('change',function() {
            var usersSelect = $("#users");
            if ($(this).is(':checked')) {
                usersSelect.prop('disabled', true);
            } else {
                usersSelect.prop('disabled', false);
            }
        });

        $('#prop-users').on('change',function() {
            var usersSelect = $("#users");
            if ($(this).is(':checked')) {
                usersSelect.prop('disabled', true);
            } else {
                usersSelect.prop('disabled', false);
            }
        });
    });
</script>
@endsection
@extends('layouts.admin.master')

@section('content')
	<div class="breadcrumb-wrapper">
        <div class="row align-items-center">
            <div class="col-8">
                <h1>Create User</h1>
            </div>
            <div class="col-4 text-right">
                <a href="{{ route('admin.users') }}" class="btn add-btn">
                    <i class="mdi mdi-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>

	<div class="card user-card">
		<div class="card-body py-5">
			<form method="post" id="create-user" action="{{route('admin.users.store')}}" enctype="multipart/form-data" data-parsley-validate>
				@csrf
				<div class="row m-0 justify-content-center">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required>
						</div>
						<div class="form-group">
							<label class="text-dark mb-2 font-weight-medium d-inline-block" for="">Status</label>
							<ul class="list-unstyled list-inline">
								<li class="d-inline-block mr-3">
									<label class="control control-radio">Active
										<input type="radio" name="status" value="1" checked="checked">
										<div class="control-indicator"></div>
									</label>
								</li>
								<li class="d-inline-block mr-3">
									<label class="control control-radio">Inactive
										<input type="radio" name="status" value="0">
										<div class="control-indicator"></div>
									</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="form-footer pt-5 mt-4 text-center">
					<button type="submit" class="btn btn-submit">Submit</button>
				</div>
			</form>
		</div>
	</div>


@endsection

@section('script')
<script>
$('#create-user').parsley();	
</script>
@endsection
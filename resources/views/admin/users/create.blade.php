@extends('layouts.admin.master')

@section('content')
<div class="breadcrumb-wrapper">
	<h1>Create User</h1>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Create User</h2>
			</div>

			<div class="card-body">
				<form method="post" id="create-user" action="{{route('admin.users.store')}}" enctype="multipart/form-data" data-parsley-validate>
					@csrf
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
									<input type="radio" name="status" checked="checked">
									<div class="control-indicator"></div>
								</label>
							</li>
							<li class="d-inline-block mr-3">
								<label class="control control-radio">In Active
									<input type="radio" name="status">
									<div class="control-indicator"></div>
								</label>
							</li>
						</ul>
					</div>
					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
<script>
$('#create-user').parsley();	
</script>
@endsection
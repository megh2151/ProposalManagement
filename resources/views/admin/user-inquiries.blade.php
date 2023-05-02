@extends('layouts.admin.master')

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/responsive.datatables.min.css')}}" rel='stylesheet'>
@endsection
@section('content')
<div class="breadcrumb-wrapper">
	<h1>User Inquiries</h1>
</div>

<div class="row">
	<div class="col-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom d-flex justify-content-between">
				<h2>User Inquiries</h2>
			</div>
			<div class="card-body">
				<div class="responsive-data-table" id="responsive-data-table_wrapper">
					<table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Message</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($user_inquiries as $inquiries)
							<tr>
								<td>{{$inquiries->name}}</td>
								<td>{{$inquiries->message}}</td>
								<td>{{$inquiries->subject}}</td>
								<td>{{$inquiries->message}}</td>
							</tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('admin/assets/plugins/data-tables/datatables.responsive.min.js')}}"></script>
@endsection
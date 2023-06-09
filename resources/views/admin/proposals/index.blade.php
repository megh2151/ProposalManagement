@extends('layouts.admin.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
.star-rating {
    display: inline-flex;
    flex-direction: row-reverse;
    font-size: 16px;
    line-height: 1;
}

.star-rating .star {
    color: #ddd;
    cursor: pointer;
}

.star-rating .star:hover,
.star-rating .star:hover ~ .star {
    color: gold;
}

.star-rating .filled {
    color: gold;
}
</style>
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Proposals</h1>
    </div>
    <form action="{{ route('admin.proposal.search') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="author_last_name" class="form-control" placeholder="Author Last Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="author_first_name" class="form-control" placeholder="Author First Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-id="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                <input type="text" class="form-control datepicker" id="date_submitted" placeholder="Date Submitted" name="date_submitted" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    <div class="card card-proposals">
        
        <div class="card-body">
            <div class="basic-data-table">
                <table id="basic-data-table" class="table nowrap" data-order='[[ 6, "desc" ]]'>
                    <thead>
                        <tr>
                            <th>Follow Up</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Contact</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Submitted Date</th>
                            <th>Note</th>
                            <th>Status</th>
                            @if(auth()->user() && auth()->user()->role_id==2)
                                        <th>Rating</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $proposal)
                            <tr>
                                <td><input type="checkbox" name="is_followup" {{$proposal->is_followup ? 'checked' : ''}} class="is_followup" data-followup="{{$proposal->is_followup}}" data-proposalId="{{$proposal->id}}"></td>
                                <td>{{ substr($proposal->title, 0, 70) }}</td>
                                <td><img src="{{ $proposal->user->profile_photo ? asset($proposal->user->profile_photo) : asset('storage/profiles/default_user.jpg') }}" alt="{{ $proposal->user->name }}" width="40" height="40" class="rounded-circle">
                                {{ $proposal->user->name }}</td>
                                <td>{{ $proposal->user->email }}
                                {{$proposal->user->country_code}} {{ $proposal->user->phone }}</td>
                                <td>{{ $proposal->category->name }}</td>
                                <td>{{ $proposal->subcategory->name }}</td>
                                <td>{{ date('Y-m-d h:i:s A',strtotime($proposal->created_at->toDateTimeString())) }}</td>
                                <td>
                                @if(auth()->user() && (auth()->user()->role_id==2 && $proposal->is_gov_access) || auth()->user()->role_id==1)  
                                <a href="javascript:void(0);" class="update-note mr-1" data-proposalId="{{$proposal->id}}" data-status="{{$proposal->status}}" data-note="{{$proposal->note}}">View</a>
                                @endif
                                </td>
                                <td>{{ $proposal->status }}</td>
                                 @if(auth()->user() && auth()->user()->role_id==2)
                                <td>
                                    @if($proposal->is_gov_access)
                                    <div class="star-rating" data-proposal-id="{{ $proposal->id }}">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <span class="star {{ $proposal->rating >= $i ? 'filled' : 'empty' }}"><i class="fas fa-star"></i></span>
                                        @endfor
                                    </div>
                                    @endif
                                </td>
                                @endif
                                <td>
                                @if(auth()->user() && (auth()->user()->role_id==2 && $proposal->is_gov_access) || auth()->user()->role_id==1)    
                                <a href="{{route('admin.proposal.view',['id'=>$proposal->id])}}" class="mr-1"><button class="rounded-btn btn-info mb-2"><i class="mdi mdi-eye"></i></button></a> @if($proposal->file_path) <a href="/admin/proposals/download/{{$proposal->file_path}}" class="download mr-1"><button class="rounded-btn btn-primary mb-2"><i class="mdi mdi-download"></i></button></a>@endif <a href="javascript:void(0);" class="update-status mr-1" data-proposalId="{{$proposal->id}}" data-status="{{$proposal->status}}"><button class="rounded-btn btn-success mb-2" title="Update Status"><i class="mdi mdi-account-check"></i></button></a> <a href="javascript:void(0);" class="update-note mr-1" data-proposalId="{{$proposal->id}}" data-status="{{$proposal->status}}" data-note="{{$proposal->note}}"><button class="rounded-btn btn-primary mb-2" title="Update Note"><i class="mdi mdi-table-edit"></i></button></a>  
                                <a class="" href="{{ route('admin.proposal.chat', ['id' => $proposal->id]) }}"><button class="rounded-btn btn-warning mb-2" title="Send Message"><i class="mdi mdi-message-text"></i></button>
                                </a>
                                @else
                                    <a href="javascript:void(0);" class="send-request" data-proposalId="{{$proposal->id}}">Send Access Request</a>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.proposal.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="proposalId" id="proposalId" value="">
                        <div class="form-group">
                        <select class="form-control" id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="cancel">Cancel</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="note" name="note" rows="6"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-pill">Update</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sendRequest" tabindex="-1" role="dialog" aria-labelledby="sendRequestLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendRequestLabel">Send Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.proposal.request') }}" method="post">
                        @csrf
                        <input type="hidden" name="propId" id="propId" value="">
                        <div class="form-group">
                            <textarea class="form-control" id="request_note" name="request_note" rows="4"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-pill">Update</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $(document).on("click", ".update-status", function() {
                var proposalId = $(this).attr('data-proposalId');
                var status = $(this).attr('data-status');
                $('#status').val(status);
                var thisObj = $(this);
                $("#status").show();
                $("#note").hide();
                $("#proposalId").val(proposalId);
                $("#exampleModal").modal('show');
            });

            $(document).on("click", ".update-note", function() {
                var proposalId = $(this).attr('data-proposalId');
                var status = $(this).attr('data-status');
                var note = $(this).attr('data-note');
                var thisObj = $(this);
                $('#status').val(status);
                $("#note").val(note)
                $("#proposalId").val(proposalId);
                $("#note").show();
                $("#status").hide();
                $("#exampleModal").modal('show');
            });
            
            $(document).on("click", ".send-request", function() {
                var proposalId = $(this).attr('data-proposalId');
                $("#propId").val(proposalId);
                $("#sendRequest").modal('show');
            });

            $('.is_followup').on('click', function() {
                var isChecked = $(this).prop('checked');
                var proposalId = $(this).attr('data-proposalId');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    is_followup: isChecked ? 1 : 0,
                    _token: csrfToken,
                    proposalId:proposalId
                };

                // Send an AJAX request to update the database
                $.ajax({
                url: "{{ route('admin.proposal.update') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    alert('Follow up updated successfully');
                    console.log('Checkbox value updated successfully!');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error updating checkbox value:', errorThrown);
                }
                });
            });

            $('.star-rating .star').on('click', function() {
                var star = $(this);
                var reversedIndex = star.siblings('.star').length - star.index();
                var rating = reversedIndex + 1;
                var proposalId = star.closest('.star-rating').data('proposal-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                
                $.ajax({
                    url: '/admin/proposals/' + proposalId + '/update-rating',
                    type: 'POST',
                    data: { rating: rating, _token: csrfToken },
                    success: function(response) {
                        // Handle success response if needed
                        alert('Rating updated successfully');
                        
                        // Update the star rating display
                        star.addClass('filled');
                        star.nextAll('.star').addClass('filled');
                        star.prevAll('.star').removeClass('filled');
                    },
                    error: function(error) {
                        // Handle error response if needed
                        console.error('Error updating rating:', error);
                    }
                });
            });
        });
    </script>
@endsection

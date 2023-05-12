@extends('layouts.admin.master')

@section('style')
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Proposals</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Proposals</h2>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table id="basic-data-table" class="table nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Follow Up</th>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proposals as $proposal)
                                    <tr>
                                        <td><input type="checkbox" name="is_followup" {{$proposal->is_followup ? 'checked' : ''}} class="is_followup" data-followup="{{$proposal->is_followup}}" data-proposalId="{{$proposal->id}}"></td>
                                        <td>{{ $proposal->title }}</td>
                                        <td>{{ $proposal->user->name }}</td>
                                        <td>{{ $proposal->category->name }}</td>
                                        <td>{{ $proposal->subcategory->name }}</td>
                                        <td>{{ $proposal->note }}</td>
                                        <td>{{ $proposal->status }}</td>
                                        </td>
                                        <td><a target="_blank" href="/admin/proposals/preview/document.pdf" class="">View</a> | <a href="/admin/proposals/download/document.pdf" class="download">Download</a> | <a href="javascript:void(0);" class="update-status" data-proposalId="{{$proposal->id}}" data-status="{{$proposal->status}}">Update Status</a> | <a href="javascript:void(0);" class="update-note" data-proposalId="{{$proposal->id}}" data-status="{{$proposal->status}}" data-note="{{$proposal->note}}">Update Note</a>
                                        <a class="mr-2" href="{{ route('admin.proposal.chat', ['id' => $proposal->id]) }}">
                                                <button class="rounded-btn btn-success"><i class="mdi mdi-chat"></i></button>
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-pill">Update</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="document"></div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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
                    console.log('Checkbox value updated successfully!');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error updating checkbox value:', errorThrown);
                }
                });
            });
        });
    </script>
@endsection

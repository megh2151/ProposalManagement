@extends('layouts.admin.master')

@section('css')
    <link href="{{ asset('admin/assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Orders Details</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Order {{ $order->id }}</h2>
                    <h2>Order status <span
                            class="strong  {{ $order->status == 'canceled' ? 'text-danger' : 'text-info' }}">{{ $order->status }}</span>
                    </h2>
                    <a class="dropdown show" href="">
                        <a href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Change Status</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <button
                                onclick="event.preventDefault(); document.getElementById('update-status-form-delivered').submit();"
                                class="dropdown-item">Delivered</button>
                            <form id="update-status-form-delivered"
                                action="{{ route('admin.order.updateStatus', ['id' => $order->id, 'newStatus' => 'delivered']) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <button
                                onclick="event.preventDefault(); document.getElementById('update-status-form-ordered').submit();"
                                class="dropdown-item">Ordered</button>
                            <form id="update-status-form-ordered"
                                action="{{ route('admin.order.updateStatus', ['id' => $order->id, 'newStatus' => 'ordered']) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <button
                                onclick="event.preventDefault(); document.getElementById('update-status-form-pending').submit();"
                                class="dropdown-item">pending</button>
                            <form id="update-status-form-pending"
                                action="{{ route('admin.order.updateStatus', ['id' => $order->id, 'newStatus' => 'pending']) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                Reject
                            </button>
                        </div>
                    </a>
                </div>

                <div class="card-body">
                    <div class="responsive-data-table" id="responsive-data-table_wrapper">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            @if ($item->product)
                                                <img src="{{ url('storage/' . $item->product->image) }}"
                                                    width="50"></img>
                                            @endif
                                        </td>
                                        <td>{{ $item->product ? $item->product->name : '' }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    please conform you want's to reject the ordr
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('update-status-form-canceled').submit();">Conform</button>
                    <form id="update-status-form-canceled"
                        action="{{ route('admin.order.updateStatus', ['id' => $order->id, 'newStatus' => 'canceled']) }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>
@endsection

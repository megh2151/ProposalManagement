@extends('layouts.admin.master')

@section('css')
    <link href="{{ asset('admin/assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Orders</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Orders</h2>
                </div>
                <div class="card-body">
                    <div class="responsive-data-table" id="responsive-data-table_wrapper">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>RPay Ord ID</th>
                                    <th>User</th>
                                    <th>Address1</th>
                                    <th>Address2</th>
                                    <th>City</th>
                                    <th>Action</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Zip</th>
                                    <th>Rozar Pay Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ date('d M y H:m:i', strtotime($order->created_at)) }}</td>
                                        <td>Rs. {{ $order->total }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->rozar_pay_order_id }}</td>
                                        <td>{{ $order->firstname }} {{ $order->lastname }}
                                            <br />{{ $order->mobile }}<br>{{ $order->email }}
                                        </td>
                                        <td>{{ $order->address1 }}</td>
                                        <td>{{ $order->address2 }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td><a class="btn border border-primary text-primary"
                                                href="{{ route('admin.order.details', ['id' => $order->id]) }}">View</a>

                                        </td>
                                        <td>{{ $order->state }}</td>
                                        <td>{{ $order->country }}</td>
                                        <td>{{ $order->zipcode }}</td>
                                        <td>{{ $order->rozar_pay_response }}</td>
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
    <script src="{{ asset('admin/assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>
@endsection

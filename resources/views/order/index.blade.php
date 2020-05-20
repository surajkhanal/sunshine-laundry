@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Orders</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="action-row">
                <a href="/orders/create" class="btn btn-primary btn-round mb-3">Create Order</a>
            </div>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client ID</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Issued By</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->getOrderID() }}</td>
                            <td>CL00001</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->order_status->order_status_name }}</td>
                            <td>{{ $order->user->user_name }} ({{$order->user->getUserID()}})</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@extends('layouts.app')

@section('content')
     <div class="container-fluid">
        <h2 class="page-title">Order Details #{{$order->getOrderID()}}</h2>
        <hr>
        @include('layouts.message')
         <div class="row">
             <div class="col-lg-12">
                <div class="action-row">
                    <a href="/orders/" class="btn btn-primary btn-round mb-3">Back</a>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-2">
                            <div class="card-header">
                                Client Info
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Client ID: {{$order->client->getClientID()}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Name: {{$order->client->client_name}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Email: {{$order->client->email}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Phone Number: {{$order->client->phone_number}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">Services</div>
                            <div class="card-body pb-0">
                                <ul>
                                    @if($order->services)
                                        @foreach($order->services as $service)
                                            <li>{{$service->service_name}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <form action="{{action('OrderController@update', $order->id)}}" class="status-form"method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="order-status">Order Status</label>
                                <select name="order_status" id="order-status" class="form-control">
                                    @foreach($order_status as $stat)
                                        <option value="{{ $stat->id }}" {{$stat->id == $order->order_status->id ? 'selected':'' }} >{{ $stat->order_status_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Items Info
                    </div>
                    <div class="card-body">
                        <table class="table nodt">
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                           
                            @if(count($order->items) > 0)
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->order_details->quantity }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>${{ $item->price * $item->order_details->quantity }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
             </div>
         </div>
     </div>
@endsection
@push('scripts')
    <script>
        $('#order-status').change(function(event){
            let value = event.currentTarget.value;
            console.log(value);
            $('.status-form').submit();
        });
    </script>
@endpush
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Invoices</h2>
    <hr>
    @include('layouts.message')
    <div class="row">
        <div class="col-lg-12">
            <div class="action-row"></div>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Payment Status</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($invoices) > 0)
                        @foreach($invoices as $invoice)
                        <tr class="{{ $invoice->paymentStatus->payment_status_name }}">
                            <td>{{ $invoice->id }}</td>
                            <td>{{  date('Y-m-d', strtotime($invoice->issue_date))  }}</td>
                            <td>{{ date('Y-m-d', strtotime($invoice->due_date)) }}</td>
                            <td>{{ $invoice->client->getClientID() }}</td>
                            <td>{{ $invoice->client->client_name }}</td>
                            <td class="d-flex align-items-center">
                                <form class="status-form" action="{{action('InvoiceController@update', $invoice->id)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <select name="payment_status" id="payment-status" class="form-control" onchange="document.querySelector('.status-form').submit();">
                                        @foreach($payment_status as $stat)
                                            <option value="{{ $stat->id }}"{{ $invoice->payment_status_id == $stat->id ? 'selected':'' }}>{{$stat->payment_status_name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td><a href="/download/{{$invoice->id}}">Download Invoice</a></td>
                            <td><a href="/orders/{{$invoice->order_id}}" class="btn btn-sm btn-primary">Details</a></td>
                        </tr>
                        @endforeach
                    @endif
                    

                </tbody>
            </table>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@push('scripts')
    <script>
      
    </script>
@endpush
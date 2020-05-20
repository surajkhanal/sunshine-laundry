@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Invoices</h2>
    <hr>
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

                    </tr>
                </thead>
                <tbody>
                    @if(count($invoices) > 0)
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->issue_date }}</td>
                            <td>{{ $invoice->due_date }}</td>
                            <td>{{ $invoice->client->getClientID() }}</td>
                            <td>{{ $invoice->client->client_name }}</td>
                            <td>{{ $invoice->paymentStatus->payment_status_name }}</td>
                        </tr>
                        @endforeach
                    @endif
                    

                </tbody>
            </table>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
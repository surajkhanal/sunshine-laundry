@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">All Clients</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            
            @include('layouts.message')

            <div class="action-row mb-3">
                <a href="/clients/create" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add new client</a>
            </div>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>ABN</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Registered on</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($clients) > 0)
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->getClientID() }}</td>
                                <td>{{ $client->client_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->ABN }}</td>
                                <td>{{ $client->address }}</td>
                                <td>{{ $client->phone_number }}</td>
                                <td>{{ $client->created_at }}</td>
                                <td>
                                <a href="{{route('clients.edit', $client->id)}}" class="btn btn-sm btn-primary">Edit</a>
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
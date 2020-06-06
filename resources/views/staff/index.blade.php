@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">All Staff</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="action-row mb-3">
                @can('manage-staff', Auth::user())
                    <a href="/staff/create" class="btn btn-primary btn-round">Add new staff</a>
                @endcan
            </div>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($staffs) > 0)
                        @foreach($staffs as $staff)
                        <tr>
                            <td>{{ $staff->id }}</td>
                            <td>{{ $staff->user_name }}</td>
                            <td>{{ $staff->phone_number }}</td>
                            <td>{{ $staff->address }}</td>
                            <td>
                                <a href="/staff/{{$staff->id}}/edit" class="btn btn-sm btn-primary">Edit</a>
                                {{-- <a href="#" class="btn btn-sm btn-">Disable</a> --}}
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
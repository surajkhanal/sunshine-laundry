@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Add new client</h2>
    <hr>
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="{{ action('ClientController@store') }}" method="POST">
                @csrf
                <div class="form-row align-items-center mb-3">
                    <label for="client_name" class="label-control col-3 mb-0">Client Name</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="client_name" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ old('address') }}" placeholder="Client Name" required autofocus>
                        @error('client_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="abn" class="label-control col-3 mb-0">ABN</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="abn" name="abn" class="form-control @error('abn') is-invalid @enderror" value="{{ old('abn') }}" placeholder="ABN" required>
                        @error('abn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="email" class="label-control col-3 mb-0">Email </label>
                    <div class="form-group col-9 mb-0">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="phone_number" class="label-control col-3 mb-0">Phone Number</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Phone Number" required>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="address" class="label-control col-3 mb-0">Address</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Address" required>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-round">Save</button>
                </div>
            </form><!-- /form -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->    
@endsection
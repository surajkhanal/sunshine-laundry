@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Edit Staff info</h2>
    <hr>
    @include('layouts.message')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="{{ action('StaffController@update', $staff->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ $staff->user_name }}" autocomplete="name" autofocus>

                        @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" autocomplete="email" >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $staff->address }}">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $staff->phone_number }}">

                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6 offset-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="status" {{$staff->user_status == 0 ? 'checked':''}} class="custom-control-input" id="status">
                            <label class="custom-control-label" for="status">Disable account</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-round">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form><!-- /form -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
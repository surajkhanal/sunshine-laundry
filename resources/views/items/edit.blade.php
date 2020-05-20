@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Edit item</h2>
    <hr>
    <div class="row">
        <div class="col-lg-6 m-auto">
        <form action="{{ action('ItemController@update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="form-row align-items-center mb-3">
                    <label for="item_name" class="label-control col-3 mb-0">Item Name</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="item_name" name="item_name" class="form-control  @error('item_name') is-invalid @enderror" value="{{ $item->item_name }}" placeholder="Item Name" required autofocus>
                        @error('item_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="price" class="label-control col-3 mb-0">Price</label>
                    <div class="form-group col-9 mb-0">
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $item->price }}" placeholder="Price" required>
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label for="item_image" class="label-control col-3 mb-0">Item Image </label>
                    <div class="form-group col-9 mb-0">
                        <input type="file" id="item_image" name="item_image" class="form-control" value="" placeholder="Item Image">
                        @error('item_image')
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
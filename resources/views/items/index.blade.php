@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">All Items</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            
            @include('layouts.message')

            <div class="action-row mb-3">
                @can('create-item', Auth::user())
                <a href="{{ route('items.create') }}" class="btn btn-primary btn-round"><i class="fas fa-plus mr-2"></i> New Item</a>
                @endcan
            </div>
            <table class="table shadow bg-white">
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->getItemID() }}</td>
                                <td>{{ __($post->item_name) }}</td>
                                <td>${{ $post->price }}</td>
                                <td>
                                    @isset($post->item_image)
                                    <figure style="width: 120px;">
                                        <img src="{!! asset('storage/'. $post->item_image ) !!}" class="img-fluid"></td>
                                    </figure>
                                    @endisset
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    @can('manage-item', Auth::user())
                                        <a href="{{ route('items.edit', ['item' => $post->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @endcan
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

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="page-title">Dashboard</h2>
            <hr>
            <div class="row">
                <div class="col-md-3">
                     <div class="card">
                         <div class="card-header">Clients</div>
                         <div class="card-body font-weight-bold">
                            {{ count($clients) }}
                         </div>
                     </div>
                </div>
                <div class="col-md-3">
                     <div class="card">
                         <div class="card-header">Total Staff</div>
                         <div class="card-body font-weight-bold">
                             {{count($users)}}
                         </div>
                     </div>
                </div>
                <div class="col-md-3">
                     <div class="card">
                         <div class="card-header">Total Order</div>
                         <div class="card-body font-weight-bold">
                             {{count($orders)}}
                         </div>
                     </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

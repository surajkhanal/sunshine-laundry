@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="alert alert-success" style="display: none;"></div>
    <h2 class="page-title">Services</h2>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="action-row mb-3">
                @can('manage-service', Auth::user())
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#serviceModal">Add New Service</button>
                @endcan
            </div>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Service Code</th>
                        <th>Service Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        @can('manage-service', Auth::user())
                        <th>Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @if(count($services) > 0)
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->getServiceID() }}</td>
                            <td>{{ $service->service_name }}</td>
                            <td>{{ $service->created_at }}</td>
                            <td>{{ $service->updated_at }}</td>
                            @can('manage-service', Auth::user())
                            <td class="d-flex align-items-center">
                                <a href="#serviceModal" onclick="editService({{$service->id}}, '{{$service->service_name}}')" class="btn btn-sm btn-primary mr-1 service-edit">Edit</a>
                                <form action="{{ action('ServiceController@destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach                        
                    @endif
                    
                
                   
                </tbody>
            </table>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="{{ action('ServiceController@store') }}" method="POST" v-on:submit.prevent="saveService" class="serviceForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="serviceModalLabel">Add new service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Service Name</label>
                @csrf
                <input type="hidden" id="service_id" value="">
                <input type="text" class="form-control" id="service_name" placeholder="Service Name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-save-service">Save</button>
        </div>
      </div>
    </form>
    </div>
  </div>
 
@endsection

@push('scripts')
    <script>
        
        let editService = function(id, service_name) {
                $('#service_id').val(id);
                $('#service_name').val(service_name);
                $('#serviceModalLabel').text('Edit service');
                $('.btn-save-service').text('Update');
                $('#serviceModal').modal('show');

            }
        $(document).ready(function(){
            $('.action-row .btn').click(function() {
                $('#serviceModalLabel').text('Add new service'); 
                $('.btn-save-service').text('Save');
                $('#service_id').val('');
                $('#service_name').val('');
            });
            $('.serviceForm').submit(function(e) {
                e.preventDefault();
    
                let action = $(this).attr('action');
                let method = 'POST';
                let service_name = $('#service_name').val();
                let service_id = $('#service_id').val();

                let data = { service_name: service_name, _token: $('input[name=_token]').val() };
                if(service_id) {
                    action = "{{url('/')}}/services/"+service_id;
                    method =  'PUT';
                }
                if(service_name) {
                    submitData(method, data);
                }

                function submitData(method, data) {
                    $.ajax({
                        url: action,
                        type: method, 
                        data: data,
                        success: function(res) {
                            $('.btn-close').click();
                            $('.alert-success').fadeIn();
                            $('.alert-success').text(res.msg);
                            $('.modal-backdrop').removeClass('show');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        },
                        error: function(err) {
                            alert(err.responseJSON.message);
                        }
                    });
                }
            });

            
        });
    </script>
@endpush
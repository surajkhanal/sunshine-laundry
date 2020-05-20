@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">New order</h2>
    <div class="alert alert-success" v-if="message">@{{message}}</div>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <div class="action-row">
                    <div class="form-row align-items-center" >
                        <div class="form-group col-4 mb-0 mr-2 d-flex align-items-center flex-fill">
                            <select name="client_id" id="client" class="form-control"v-model="client" v-select2>
                                @if(count($data['clients']) > 0)
                                    @foreach($data['clients'] as $client)
                                    <option value="{{$client->id}}">{{ $client->getClientID() }} {{ $client->client_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-4 mb-0 mr-2 d-flex align-items-center flex-fill">
                            <i class="fas fa-search"></i>
                            <input type="text" name="item_search" class="form-control border-0 bg-transparent" placeholder="Search item">
                        </div>
                        <button class="btn btn-primary btn-">Search</button>
                    </div>
                    <hr>
            </div>
            <div class="item-grid grid">
                <div class="item grid__col-3  bg-white" v-for="item in items" v-on:click="addItemToCart($event, item)">
                    <div class="item-thumb">
                    <img v-bind:src="'/storage/'+item.item_image" alt="">
                    </div>
                    <div class="item-info">
                        <h2 class="item-name">@{{ item.item_name }}</h2>
                        <p class="item-price">$ @{{ item.price }}</p>
                    </div>
                </div>
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="checkout-area">
                <h2 class="section-title">Checkout</h2>
                <hr>
                
                    <div class="checkout-items">
                        <div class="checkout-item" v-for="item in itemsInCart" >
                            <span class="item-name">@{{item.item_name}}</span>
                            <span class="item-qty">
                                <button type="button" v-on:click="decrementQty(item.id)" class="qty-decrement"><i class="fas fa-minus"></i></button>
                                <span class="qty-label">@{{item.qty}}</span>
                                <button type="button" v-on:click="incrementQty(item.id)" class="qty-increment"><i class="fas fa-plus"></i></button>
                            </span>
                            <span class="item-subtotal">$@{{item.subtotal}}</span>
                        </div>
                        <span v-if="!itemsInCart.length">No items available.</span>
                    </div>
                    <hr>
                    <div class="service-area">
                        <label for="">Select Service</label>
                        @if(count($data['services']))
                            @foreach($data['services'] as $service)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="services" v-on:change="addService({{$service->id}})" class="custom-control-input" id="{{$service->service_name}}">
                                <label class="custom-control-label" for="{{$service->service_name}}">{{$service->service_name}}</label>
                            </div>
                            @endforeach
                        @endif
                        
                    </div>
                    <div class="total py-2 mt-2 border-top border-bottom d-flex justify-content-between ">
                        <strong>Total</strong>
                        <strong class="total-price">$@{{total}}</strong>
                    </div>
                    <button class="btn btn-warning btn-block" v-bind:disabled="!itemsInCart.length" data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button>
                    <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#invoiceModal" v-bind:disabled="!itemsInCart.length">Print Invoice</button>
            </div>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mb-3 text-center">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>
            <div class="client-info mb-2">
                <p class="info-label mb-1"><span class="mr-3">Client name:</span> @{{getClient('client_name')}}</p>
                <p class="info-label mb-1"><span class="mr-3">Phone number:</span> @{{getClient('phone_number')}}</p>
            </div>
            <div class="invoice-table">
              <div>
                  <strong>Item Code</strong>
                  <strong>Item</strong>
                  <strong>Quantity</strong>
                  <strong>Price</strong>
              </div>
              <div v-for="item in itemsInCart">
                  <span>@{{item.id}}</span>
                  <span>@{{item.item_name}}</span>
                  <span>@{{item.qty}}</span>
                  <span>$@{{item.subtotal}}</span>
              </div>
              <div>
                  <span class="border-0"></span>
                  <span class="border-0"></span>
                  <strong class="text-right">Total</strong>
                  <span class="">$@{{total}}</span>
              </div>
          </div>
          <div class="invoice-table mb-2">
            <div>
                <strong>Service</strong>
                <span v-for="service in services">@{{getService(service)}}</span>
            </div>
        </div>
        <p class="text-right small font-italic">Date: {{date('Y-m-d')}}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" v-on:click="saveInvoice()" v-bind:disabled="isSubmitting">Save Invoice</button>
            <button type="button" class="btn btn-primary" v-on:click="printInvoice()" v-bind:disabled="isSubmitting">Print Invoice</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-bind:disabled="isSubmitting">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        new Vue({
            el: '.page-content',
            data:{
                items: @json($data['items']),
                itemsInCart: [],
                services: [],
                total: 0,
                clients: @json($data['clients']),
                client: null,
                isSubmitting: false,
                message: ''
            },
            methods: {
                inCart: function(itemId) {
                    let foundItems = this.itemsInCart.filter((item) => item.id === itemId);
                    return foundItems.length > 0 ? true : false;
                },

                addItemToCart: function(event, itemObj) {
                    event.currentTarget.classList.toggle('added');
                    if (!this.inCart(itemObj.id)) {
                        let foundItems = this.items.filter(item => item.id === itemObj.id);
                        if (foundItems.length > 0) {
                            const item = foundItems[0];
                            item['qty'] = 1;
                            item['subtotal'] = item.price * item.qty;
                            this.itemsInCart.push(item);
                        }
                    } else {
                        let index = this.itemsInCart.findIndex((item) => { return item.id === itemObj.id });
                        if(index > -1) {
                            this.itemsInCart.splice(index, 1);
                        }
                    }
                    this.calculateTotal();
                },

                calculateTotal: function() {
                    this.total = 0;
                    this.itemsInCart.forEach((item, index) => {
                        this.total += item.subtotal;
                    });
                },

                incrementQty: function(itemId) {
                    console.log(itemId);
                    if(itemId) {
                        let index = this.itemsInCart.findIndex((item) => { return item.id === itemId });
                        this.itemsInCart[index].qty = this.itemsInCart[index].qty + 1;
                        this.itemsInCart[index].subtotal = this.itemsInCart[index].price * this.itemsInCart[index].qty;
                        this.calculateTotal();
                    }
                },

                decrementQty: function(itemId) {
                    if(itemId) {
                        let index = this.itemsInCart.findIndex((item) => { return item.id === itemId });
                        this.itemsInCart[index].qty = this.itemsInCart[index].qty > 1 ? this.itemsInCart[index].qty - 1: this.itemsInCart[index].qty;
                        this.itemsInCart[index].subtotal = this.itemsInCart[index].price * this.itemsInCart[index].qty;
                        this.calculateTotal();
                    }
                },

                addService: function(service_id) {
                    let index = this.services.findIndex(id => id === service_id);
                    if(index == -1) {
                        this.services.push(service_id);
                    } else {
                        this.services.splice(index, 1);
                    }
                },

                getClient: function(key) {
                    let client = this.clients.filter(c => c.id == this.client);
                    if(client.length) {
                        return client[0][key];
                    }
                },

                getService: function(id) {
                    const original_services = @json($data['services']);
                    let fservice = original_services.filter(s => s.id == id);
                    console.log(id);
                    if(fservice.length) {
                        return fservice[0]['service_name'];
                    }
                },

                printInvoice: function() {
                    let prtContent = document.getElementById("invoiceModal");
                    let WinPrint = window.open('', '', 'left=0,top=0,width=584,height=600,toolbar=0,scrollbars=0,status=0');
                    WinPrint.document.write('<html><head>');
                    WinPrint.document.write('<link rel="stylesheet" href="{{ asset('css/app.css') }}" media="all">');
                    WinPrint.document.write('</head><body class="print" onload="print(); close()">');
                    WinPrint.document.write(prtContent.innerHTML);
                    WinPrint.document.write('</body></html>');
                    WinPrint.document.close();
                    WinPrint.focus();
                    this.saveInvoice();
                    // WinPrint.print();
                    // WinPrint.close();
                },

                saveInvoice: function() {
                    if(!this.client) {
                        return alert('Please select the client');
                    }
                    let url = '{{action('OrderController@store')}}';
                    let self = this;
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            orderedItems: self.itemsInCart,
                            client: self.client,
                            _token: $('meta[name=csrf-token]').attr('content')
                        },
                        beforeSend: function() {
                            self.isSubmitting = true;
                        },
                        success: function(res) {
                            console.log(res);
                            self.message = res.msg;
                            self.isSubmitting = false;
                            $('#invoiceModal').modal('hide');
                        },
                        error: function(err) {  
                            console.log(err);
                            self.isSubmitting = false;
                        }
                    })

                }
            },
            mounted: function() {
                $('#client').select2();
            }
        });
    </script>
@endpush
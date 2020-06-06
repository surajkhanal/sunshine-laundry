@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="page-title">Reports</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12 bg-white shadow-sm py-3 mb-4">
                <div class="invoices">
                    <strong>Invoices</strong>
                    <hr>
                    <div class="filters">
                        <div class="row align-items-end">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">From</label>
                                    <input type="date" name="from_date" v-model="invoice_date_from" id="invoice_from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">To</label>
                                    <input type="date" name="from_date" v-model="invoice_date_to" id="invoice_from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" v-model="payment_status">
                                        <option v-bind:value="ps.id" v-for="ps in payment_statuses">
                                            @{{ps.payment_status_name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-primary" v-on:click="filterInvoice()">Filter</button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <table class="table bg-white nodt shadow-sm">
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Issue Date</th>
                            <th>Due Date</th>
                        </tr>
                        <tr v-for="invoice in invoices">
                           <td>@{{invoice.id}}</td>
                           <td>@{{getClientName(invoice.client_id)}}</td>
                           <td>$@{{getAmount(invoice.order_id)}}</td>
                           <td>@{{getPaymentStatus(invoice.payment_status_id)}}</td>
                           <td>@{{invoice.issue_date}}</td>
                           <td>@{{invoice.due_date}}</td> 
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 bg-white shadow-sm py-3 mb-4">
                <div class="invoices">
                    <strong>Orders</strong>
                    <hr>
                    <div class="filters">
                        <div class="row align-items-end">
                            <div class="col">
                                <div class="form-group">
                                    <label for="order_from_date">From</label>
                                    <input type="date" name="from_date" v-model="order_date_from" id="order_from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="order_date_to">To</label>
                                    <input type="date" name="order_date_to" v-model="order_date_to" id="order_date_to" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" v-model="order_status">
                                        <option v-bind:value="os.id" v-for="os in order_statuses">
                                            @{{ os.order_status_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-primary" v-on:click="filterOrder()">Filter</button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <table class="table bg-white nodt shadow-sm">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Ordered Date</th>
                        </tr>
                        <tr v-for="order in orders">
                           <td>@{{order.id}}</td>
                           <td>@{{getClientName(order.client_id)}}</td>
                           <td>$@{{getAmount(order.id)}}</td>
                           <td>@{{getQuantity(order.id)}}</td> 
                           <td>@{{getOrderStatus(order.order_status_id)}}</td>
                           <td>@{{getOrderDate(order.created_at)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 bg-white shadow-sm py-3">
                <div class="invoices">
                    <strong>Clients</strong>
                    <hr>
                    <div class="filters">
                        <div class="row align-items-end">
                            <div class="col">
                                <div class="form-group">
                                    <label for="order_from_date">Registered From</label>
                                    <input type="date" name="from_date" v-model="client_date_from" id="client_from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="client_date_to">To</label>
                                    <input type="date" name="client_date_to" v-model="client_date_to" id="order_date_to" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" v-model="client_phone">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" v-model="client_email">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-primary" v-on:click="filterClient()">Filter</button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <table class="table bg-white nodt shadow-sm">
                        <tr>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>ABN</th>
                            <th>Address</th>
                            <th>Registered on</th>
                        </tr>
                        <tr v-for="client in clients">
                           <td>@{{ client.id }}</td>
                           <td>@{{ client.client_name }}</td>
                           <td>@{{ client.email }}</td>
                           <td>@{{ client.phone_number }}</td> 
                           <td>@{{ client.ABN }}</td>
                           <td>@{{ client.address }}</td>
                           <td>@{{ getOrderDate(client.created_at) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <style>
        pre {
            display: none;
            height: 0;
        }
    </style>
    <script>
        new Vue({
            el: '.page-content',
            data: {
                invoice_date_from: null,
                order_date_from: null,
                invoice_date_to: null,
                order_date_to: null,
                payment_status: null,
                order_status: null,
                client_date_from: null,
                client_date_to: null,
                client_phone: '',
                client_name: '',
                invoices: [...@json($invoices)],
                orders: [...@json($orders)],
                payment_statuses: [{id: null, payment_status_name:'All'}, ...@json($payment_statuses)],
                clients: @json($clients),  
                order_statuses: [{id: null, order_status_name: 'All'},...@json($order_statuses)],
                order_details: [...@json($order_details)],
                items: [...@json($items)],
            },
            methods: {
                getClientName: function(client_id) {
                    const client = this.clients.find(c => c.id === client_id);
                    if(client) {
                        return client.client_name;
                    }
                    return 'No client found';
                },
                
                getPaymentStatus: function(status_id) {
                    const status = this.payment_statuses.find(s => s.id === status_id);
                    if(status) {
                        return status.payment_status_name
                    }
                    return 'N/A';
                },
                
                getOrderStatus: function(status_id) {
                    const status = this.order_statuses.find(s => s.id === status_id);
                    if(status) {
                        return status.order_status_name;
                    }
                    return 'N/A';
                },
                
                getOrderDate: function(date) {
                    return new Date(date).toISOString().split('T')[0];
                },

                getQuantity: function(order_id) {
                    let orders = this.order_details.filter(od => od.order_id === order_id);
                    let qty = 0;
                    orders.map(orderedItem => {
                        qty += orderedItem.quantity
                    });
                    return qty;
                },

                getAmount: function(order_id) {
                    let orders = this.order_details.filter(od => od.order_id === order_id);
                    let amount = 0;
                    if(orders.length > 0) {
                        orders.forEach(order => {
                            amount += this.getItemPrice(order.item_code, order.quantity);
                        });
                    }
                    return amount;
                },

                getItemPrice: function(item_id, qty) {
                    let item = this.items.find(item => item.id == item_id);
                    return Number(item.price * qty);
                },

                filterInvoice: function() {
                    let self = this;
                    $.ajax({
                        url: "{{route('filterInvoice')}}",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            invoice_date_from: self.invoice_date_from,
                            invoice_date_to: self.invoice_date_to,
                            payment_status: self.payment_status,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(data) {
                            self.invoices = data;
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                },

                filterOrder: function() {
                    let self = this;
                    $.ajax({
                        url: "{{route('filterOrder')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            order_date_from: self.order_date_from,
                            order_date_to: self.order_date_to,
                            order_status: self.order_status,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(data) {
                            self.orders = data;
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                },

                filterClient: function() {
                    let self = this;
                    $.ajax({
                        url: "{{route('filterClient')}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            client_date_from: self.client_date_from,
                            client_date_to: self.client_date_to,
                            phone: self.client_phone,
                            email: self.client_email,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(data) {
                            self.clients = data;
                        },
                        error: function(err) {
                            console.log(err);
                        }
                });
            }
        }
    });
    </script>
@endpush
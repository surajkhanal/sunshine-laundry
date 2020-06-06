<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Item;
use App\Order;
use App\OrderDetail;
use App\OrderStatus;
use App\PaymentStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('reports.index', [
            'invoices' => Invoice::all(), 
            'clients' => Client::all(),
            'payment_statuses' => PaymentStatus::all(),
            'order_statuses' => OrderStatus::all(),
            'orders' => Order::all(),
            'items' => Item::all(),
            'order_details' => OrderDetail::all()
        ]);
    }

    public function filterInvoice(Request $request) {
        $invoices = Invoice::query();

        if(!is_null($request->input('invoice_date_to')) && !is_null($request->input('invoice_date_from'))) {
            $invoice_date_to = Carbon::parse($request->input('invoice_date_to'))->format('Y-m-d');
            $invoice_date_from = Carbon::parse($request->input('invoice_date_from'))->format('Y-m-d');

            $invoices = $invoices->getQuery()->whereBetween('issue_date',["$invoice_date_from 00:00:00", "$invoice_date_to 23:59:59"]);
        }
        
        if(!is_null($request->input('payment_status'))) {
            $invoices = $invoices->where('payment_status_id', $request->input('payment_status'));
        }

        return $invoices->get()->toJson();

    }

    public function filterOrder(Request $request) {
        $orders = Order::query();
        
        if(!is_null($request->input('order_status'))) {
            $orders = $orders->where('order_status_id', $request->input('order_status'));
        }

        if(!is_null($request->input('order_date_to')) && !is_null($request->input('order_date_from'))) {
            $order_date_to = Carbon::parse($request->input('order_date_to'))->format('Y-m-d');
            $order_date_from = Carbon::parse($request->input('order_date_from'))->format('Y-m-d');
            $orders = $orders->getQuery()->whereBetween('created_at',["$order_date_from 00:00:00", "$order_date_to 23:59:59"]);
        }

        return $orders->get()->toJson();
    }

    public function filterClient(Request $request) {
        $clients = Client::query();

        if(!is_null($request->input('client_date_from')) && !is_null($request->input('client_date_to'))) {
            $client_date_from = Carbon::parse($request->input('client_date_from'))->format('Y-m-d');
            $client_date_to = Carbon::parse($request->input('client_date_to'))->format('Y-m-d');
            $clients = $clients->getQuery()->whereBetween('created_at',["$client_date_from 00:00:00", "$client_date_to 23:59:59"]);
        }

        if(!is_null($request->input('email'))) {
            $clients = $clients->where('email', $request->input('email'));
        }

        if(!is_null($request->input('phone'))) {
            $clients = $clients->where('phone_number', $request->input('phone'));
        }

        return $clients->get()->toJson();
    }
}

<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Item;
use App\Order;
use App\OrderDetail;
use App\OrderStatus;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'services' => Service::all(),
            'clients' => Client::all(),
            'items' => Item::all(),
        ];
        return view('order.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'client' => 'required|numeric',
            'orderedItems' => 'required'
        ]);

        $order = new Order();
        $order->client_id = $input['client'];
        $order->order_status_id = 1;
        $order->user_id = Auth::id();
        $order->save();

        $orderData = [];
        foreach($input['orderedItems'] as $item) {
            $orderDetails = new OrderDetail();
            $orderDetails->item_code = $item['id'];
            $orderDetails->quantity = $item['qty'];
            $orderDetails->order_id = $order->id;
            $orderDetails->created_at = Carbon::now()->format('Y-m-d H:i:s');
            $orderDetails->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $orderData[] = $orderDetails->attributesToArray();
        }
        OrderDetail::insert($orderData);

        $invoice = new Invoice();
        $invoice->issue_date = Carbon::now()->format('Y-m-d');
        $invoice->due_date = Carbon::now()->addDays(8);
        $invoice->payment_status_id = 1;
        $invoice->client_id = $input['client'];
        $invoice->order_id = $order->id;
        $invoice->save();

        return response()->json(['success' => true, 'msg' => 'Order saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

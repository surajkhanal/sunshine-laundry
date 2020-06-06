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
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

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

        $order->services()->attach($request->input('services'));
        
        // $items_id = [];
        // $quantities = [];
        $attach_data = [];

        foreach($input['orderedItems'] as $item) {
            $attach_data[$item['id']] = [
                'quantity' => $item['qty']
            ];
        }

        $order->items()->attach($attach_data);

        $invoice = new Invoice();
        $invoice->issue_date = Carbon::now()->format('Y-m-d');
        $invoice->due_date = Carbon::now()->addDays(8);
        $invoice->payment_status_id = 1;
        $invoice->client_id = $input['client'];
        $invoice->order_id = $order->id;
        $invoice->save();

        $total = 0;
        foreach($order->items as $item) {
            $total += $item->price * $item->order_details->quantity;
        }

        $data = [
            'invoice_id' => $invoice->id,
            'client_name' => $order->client->client_name,
            'client_phone' => $order->client->phone_number,
            'items' => $order->items,
            'services' => $order->services,
            'total' => $total
        ];
        
        $pdf = PDF::loadView('order.pdf', compact('data'));
        $fileName = 'invoice-'.$invoice->id . '.pdf';
        $pdfFilePath = public_path('pdf/') . $fileName;
        return $pdf->save($pdfFilePath);

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
        return view('order.show', ['order' => $order, 'order_status' => OrderStatus::all()]);
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
        if($request->method() == 'PATCH') {
            $request->validate([
                'order_status' => 'required|numeric'
            ]);
            $order->order_status_id = $request->input('order_status');
            $order->update();
            return redirect('/orders/'.$order->id)->with('message', 'Successfully updated the order status');
        } else {
            return back();
        }
    }

    //  /**
    //  * Update the order status.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function updatestatus(Request $request, Order $order) {
    //     return view('order.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/orders')->with('success', 'Order deleted successfully');
    }
    
 
}

<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\PaymentStatus;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $invoices = Invoice::all();
        return view('invoices.index', ['invoices' => $invoices, 'payment_status' => PaymentStatus::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        if ($request->method() == 'PATCH') {
            $request->validate([
                'payment_status' => 'required|numeric'
            ]);

            $invoice->payment_status_id = $request->input('payment_status');
            $invoice->update();
            return redirect('/invoices')->with('success', 'Payment status updated for invoice number ' . $invoice->id);
        } else {
            return redirect('/invoices');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    /**
     * Download invoice pdf
     */
    public function download(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $file = public_path() . "/pdf/invoice-" . $invoice->id . '.pdf';

        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        if(is_file($file)) {
            return response()->download($file, null, $headers);
        } else {
            return redirect('/invoices');
        }

    }
}

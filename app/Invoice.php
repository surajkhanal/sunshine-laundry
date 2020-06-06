<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function paymentStatus() {
        return $this->belongsTo('App\PaymentStatus', 'payment_status_id');
    }

    public function order( ) {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

}

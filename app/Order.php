<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    public function getOrderID() {
        return sprintf('OR%03d', $this->id);
    }
    // Order Belongs to client
    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order_status()
    {
        return $this->belongsTo('App\OrderStatus', 'order_status_id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'order_details', 'order_id', 'item_code')
            ->as('order_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'order_id');
    }

    public function services() {
        return $this->belongsToMany('App\Service', 'order_services', 'order_id', 'service_id');
    }
}

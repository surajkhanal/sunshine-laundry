<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    //
    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function item() {
        return $this->belongsTo('App\Item', 'item_code', 'id');
    }
}

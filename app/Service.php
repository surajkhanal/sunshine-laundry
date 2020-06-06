<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    function getServiceID() {
        return sprintf('S%03d', $this->id);
    }

    public function orders() {
        return $this->belongsToMany('App\Order', 'order_services', 'order_id', 'service_id');
    }
}

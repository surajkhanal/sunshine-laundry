<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    function getClientID() {
        return sprintf('CL%05d', $this->id);
    }

    function orders() {
        $this->hasMany('App\Order');
    }
}

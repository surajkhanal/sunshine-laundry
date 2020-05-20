<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    public function invoice() {
        $this->hasOne('App\Invoice');
    }
}

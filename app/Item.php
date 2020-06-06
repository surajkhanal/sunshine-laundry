<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // protected $primaryKey = 'item_code';
    // protected $keyType = 'string';
    // public $incrementing = false;
    public function getItemID()
   {
       return sprintf('IT%03d', $this->id);
   }

   public function orders() {
       return $this->belongsToMany('App\Order', 'order_details', 'item_code', 'order_id');
   }
}

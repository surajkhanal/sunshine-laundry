<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function users() {
        return $this->hasOne('App\user', 'user_type_id');
    }
}

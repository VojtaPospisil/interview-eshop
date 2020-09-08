<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function products() {
        return $this->hasMany('App\Products');
    }
}

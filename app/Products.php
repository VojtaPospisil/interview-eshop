<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function currency() {
        return $this->belongsTo('App\Currency');
    }
}

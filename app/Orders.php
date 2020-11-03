<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $fillable = [
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productOrder()
    {
        return $this->hasMany(ProductsOrder::class, 'order_id', 'id');
    }
}

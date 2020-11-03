<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price',
    ];

//    public function currency()
//    {
//        return $this->belongsTo(Currency::class, 'currency_id');
//    }

    public function productOrder()
    {
        return $this->hasMany(ProductsOrder::class, 'product_id', 'id');
    }
}

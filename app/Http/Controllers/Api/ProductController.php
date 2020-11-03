<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResources;
use App\Products;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection(Products::all());
    }

    /**
     * @param $id
     * @return ProductResource
     */
    public function detail($id)
    {
        $product = Products::find($id);

        return new ProductResource($product);
    }

}

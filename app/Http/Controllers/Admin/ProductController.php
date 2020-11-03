<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Products;
use App\Http\Requests\ProductRequest;
use App\Template;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = Products::all();

        return view('Admin.Product.index', compact('products'));
    }

    /**
     * @param Products $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Products $product)
    {
        return view('Admin.Product.detail', compact('product'));
    }

    /**
     * Use same form as edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->edit(new Products());
    }

    /**
     * @param Products $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Products $product)
    {
        return view('Admin.Product.productForm', compact('product'));
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Products::create($request->all());

        return redirect()->route('product.index');
    }

    /**
     * @param ProductRequest $request
     * @param Products $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Products $product)
    {
        $product->update($request->all());

        return redirect()->route('product.index');
    }

    /**
     * @param Products $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return back();
    }
}

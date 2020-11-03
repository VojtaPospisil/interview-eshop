<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Orders;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $orders = Orders::all();

        return view('Admin.Order.index', compact('orders'));
    }

    /**
     * @param Orders $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Orders $order)
    {
        return view('Admin.Order.detail', compact('order'));
    }
}

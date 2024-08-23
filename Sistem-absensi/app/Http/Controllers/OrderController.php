<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'name'     => $request->name,
            'reason'   => $request->reason,
            'status'   => $request->status,
        ]);

        return new OrderResource(true, 'Data Order Berhasil Ditambahkan!', $order);
    }
}


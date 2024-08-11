<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'reason'   => 'required',
            'status'   => 'required',
        ]);

        //check if validation fails
        //
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::create([
            'name'     => $request->name,
            'reason'   => $request->reason,
            'status'   => $request->status,
        ]);

        //return response
     return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $order);
    }
}

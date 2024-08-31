<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderFailResource;
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

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all orders
        $orders = Order::latest()->paginate(5);

        //return collection of posts as a resource
        return new OrderResource(true, 'List Data Posts', $orders);
    }


    /**
 * Show
 *
 * @param  mixed $name
 * @return void
 */
public function show($name)
 {
    // Find post by name
    $order = Order::where('name', $name)->first();

    if ($order) {
        return new OrderResource(true, 'Detail Data Post!', $order);
    } else {

            $errorData = [
        'type' => '/errors/incorrect-user-pass',
        'title' => 'Incorrect username or password.',
        'status' => 401,
        'detail' => 'Authentication failed due to incorrect username or password.',
        'instance' => '/login/log/abc123',
    ];
            return (new OrderFailResource((object) $errorData))->response()->setStatusCode(401);

    }
 }


 /**
 * update
 *
 * @param  mixed $request
 * @param  mixed $name
 * @return void
 */
public function update(Request $request, $name)
{
    // find post by name
    $order = Order::where('name', $name)->firstOrFail();

    // update the order
    $order->update([
        'name'   => $request->name,
        'reason' => $request->reason,
        'status' => $request->status,
    ]);

    // return response
    return new OrderResource(true, 'Data Post Berhasil Diubah!', $order);
}


}


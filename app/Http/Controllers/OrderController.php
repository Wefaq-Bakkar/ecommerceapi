<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Locations;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with('user')->paginate(20);
        if($orders){
            foreach($orders as $order){
                foreach ($order->orderProducts as $orderproduct) {
                    $product=Product::find($orderproduct->product_id)->pluck('name');
                    $orderproduct->product_name=$product[0];
                }    }
        return response()->json($orders, 200);
    }else {
            return response()->json(['No orders found'], 404);
        }


    }
    public function show($id)
    {
        $order = Order::with('user')->find($id);
        if ($order) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Order not found']);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'total_price' => 'required',
            'date_of_delivery' => 'required',
        ]);

        try {
            $location = Locations::findOrFail($request->location_id);

            $order = new Order();
            $order->status = 'pending';
            $order->user_id = auth()->user()->id;
            $order->location_id = $request->location_id;
            $order->total_price = $request->total_price;
            $order->date_of_delivery = $request->date_of_delivery;
            $order->save();

            foreach ($request->order_products as $order_product_data) {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $order_product_data['product_id'];
                $order_product->quantity = $order_product_data['quantity'];
                $order_product->price = $order_product_data['price'];
                $order_product->save();

                $product = Product::find($order_product_data['product_id']);
                $product->amount = $product->amount - $order_product_data['quantity'];
                $product->save();
            }

            return response()->json('Order added', 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function get_user_orders($id){
        $orders=Order::where('user_id',$id)
        ::with('products',function($query){
            $query->orderBy('created_at','desc');

        })->get();
        if($orders){
         foreach($orders->orderProducts as $orderproduct){
             $product=Product::find($orderproduct->product_id)->pluck('name');
             $orderproduct->product_name=$product[0];

    }
    return response()->json($orders,200);
        }else{
            return response()->json(['No orders found'],404);
        }}
    public function change_order_status($id,Request $request){
        $order=Order::find($id);
        if($order){
           $order->update(['status'=>$request->status]);
            return response()->json('Order status changed',200);
        }else{
            return response()->json(['message'=>'Order not found']);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistories;

class OrderController extends Controller
{
    function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->groupBy('orders.order_code')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.order.order',compact('order'));
    }

    function orderDetail($ordercode){
        $orderdetail = Order::select('orders.*','orders.created_at as order_date','users.name as user_name','users.phone as user_phone','products.name as product_name',
                                    'products.price as product_price','products.photo as product_photo','products.stock as product_stock','products.id as productId')
        ->leftJoin('users','users.id','orders.user_id')
        ->leftJoin('products','products.id','orders.product_id')
       ->where('order_code', $ordercode)
        ->get();
        //dd($orderdetail);
        $payment = PaymentHistories::where('order_code',$ordercode)->first();

        $confirmStatus = [];
        $status = true;
        foreach ($orderdetail as $item) {
            array_push($confirmStatus,$item->product_stock < $item->count ? false : true);
        }

        foreach ($confirmStatus as $item) {
            if ($item == false) {
                $status = false ; break;
            }
        }
        //dd($status);
        return view('admin.order.orderDetail',compact('orderdetail','payment','status'));
    }

    function orderStatus(Request $request){
       // logger($request->all());
       Order::where('order_code',$request['order_code'])->update([
            'status' => $request['status']
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);

    }

    //confirm order //stock decrement  , it happens simultenuously
    function orderConfirm(Request $request) {
        logger($request->all());

        Order::where('order_code',$request[0]['order_code'])->update([
            'status' => 1
        ]);

        foreach ($request->all() as $item) {
            Product::where('id', $item['product_id'])->decrement('stock', $item['qty']);
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    function orderReject(Request $request){
        //logger($request->all());
        Order::where('order_code',$request['order_code'])->update([
            'status' => 2
        ]);
        return response()->json([
            'message' => 'success'
        ], 200);
    }
}

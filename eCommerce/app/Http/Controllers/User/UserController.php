<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Contact;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\PaymentHistories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //product list and filtering
    public function home(){
        $category = Category::get();
        $cart = Cart::get();
        // if(request('key')){     //video-44

        //     dd(request('key'));
        // }
        $product = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('searchkey'), function ($query) {
            $query->where('products.name', 'like', '%' . request('searchkey') . '%')
            ->orwhere('categories.name', 'like', '%' . request('searchkey') . '%');
        })
        ->when(request('categoryID') != null, function($query) {
            $query->where('products.category_id', request('categoryID'));
        })
        ->when(request('sortingItems'), function($query) {
            $strToarray = explode(",",request('sortingItems'));
            $sortname = $strToarray[0];   //it represent the first array of all sortingitems, name,price, abd date
            $sortby = $strToarray[1];
            $query->orderBy($sortname,$sortby);
        })
        ->when(request('min_price') != null && request('max_price') != null, function($query) {
            $query = $query->whereBetween('products.price',[request('min_price'), request('max_price')]);
        })
        ->when(request('min_price') && request('max_price') == null, function($query) {
            $query = $query->where('products.price','>=', request('min_price'));
        })
        ->when(request('min_price') == null && request('max_price'), function($query) {
            $query = $query->where('products.price','<=', request('max_price'));
        })
        ->get();

        return view('user.list',compact('product','category','cart'));
    }

    //cart create database
    public function addToCart(Request $request){
        Cart::create([
            'user_id' => $request->userID,
            'product_id' => $request->productID,
            'qty' => $request->count
        ]);

        ActionLog::create([
                'user_id' => $request->userID,
                'product_id' => $request->productID,
                'action' => 'addTocart'
            ]);
        return redirect()->route('cart#page');
    }

    //show cart list
    public function cartPage(){
        $cart = Cart::select('products.*','products.id as productID','carts.id as cartID','carts.qty')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)->get();
       // dd(count($cart));
        $total = 0;
        foreach($cart as $item){
            $total += $item->price*$item->qty;   //for subtotal from server side
        }
        return view('user.cart',compact('cart','total'));
    }

    //cart delete
    public function cartDelete(Request $request){  //api
        $cartID = $request->cartID;
        Cart::where('id',$cartID)->delete();

        // ActionLog::create([
        //         'user_id' => $request->userID,
        //         'product_id' => $request->productID,
        //         'action' => 'cartDelete'
        //     ]);
        return response()->json([
            'message' => 'deleted'
        ], 200);
    }

    public function cartTempo(Request $request){  //api
        //logger($request); this come from user side
        $orderArray = [];

        foreach ($request->all() as $item) { //The server cannot assume that the client’s data is structured correctly or even valid.
            array_push($orderArray,[         //The loop ensures:The incoming data is processed and structured correctly for storage or further use
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['qty'],
                'order_code' => $item['ordercode'],
                'total_amt' => $item['total_amt'],
                'status' => 0
            ]);
        }
        //logger($orderArray);  //this come from server

         // Store the array in the session
        Session::put('carttempo', $orderArray);

        // Return success response
        return response()->json([
            'message' => 'success',
            'data' => $orderArray
        ], 200);

    }

    public function payment(Request $request){
        // Retrieve the tempoCart data from the session
        //$cartTempo = $request->session()->get('tempoCart');
        //dd(Session::get('carttempo'));
        $cart = Cart::get();
        $payment = Payment::get();
        $orderItem = Session::get('carttempo');
        //dd($orderItem);
        return view('user.payment',compact('payment','orderItem','cart'));
    }


    //order create
    function orderCreate(Request $request){
        $request->validate([

            'method' => 'required',

        ]);

        $orderData = [
            'user_name' => Auth::user()->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->method,
            'order_code' => $request->order_code,
            'total_amt' => $request->total_amt,
        ];

        if($request->hasFile('payslip')){
            $newfile = uniqid().'_'.$request->file('payslip')->getClientOriginalName();
            $request->file('payslip')->move(public_path(). '/payslip',$newfile);
            $orderData['payslip_image'] = $newfile;
        }
        //dd($orderData);
        PaymentHistories::create($orderData);

        $orderItem = Session::get('carttempo');

            foreach ($orderItem as $item) {
                Order::create([
                    'user_id' => $item['user_id'],
                    'product_id' => $item['product_id'],
                    'count' => $item['count'],
                    'order_code' => $item['order_code'],
                    'status' => $item['status']
                ]);
            };

            Cart::where('user_id',$item['user_id'])->delete();

            return redirect()->route('order#list');

    }

    //user order list
    function orderList(){
        $cart = Cart::get();
        $orderlist = Order::select('orders.*','payment_histories.total_amt as total_amt')->where('user_id',Auth::user()->id)->groupBy('order_code')
                ->leftJoin('payment_histories','orders.order_code','payment_histories.order_code')
                ->get();
       // dd($orderlist);
        return view('user.orderList',compact('orderlist','cart'));
    }

    //user review create
    function reviewCreate(Request $request){
        //dd($request->all());
        Comment::create([
            'user_id'=>$request->userID,
            'product_id' => $request-> productID,
            'message' => $request->review
        ]);

        ActionLog::create([
                'user_id' => $request->userID,
                'product_id' => $request->productID,
                'action' => 'review'
            ]);

        return back();
    }

    public function reviewDelete($id){
        Comment::where('id',$id)->delete();
        return back();
    }

    //rating create
    function ratingCreate(Request $request){
        //dd($request->all());
        Rating::updateOrcreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productID,
        ],[

            'count' => $request->productRating,
        ]);

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productID,
            'action' => 'rating'
        ]);
        return back();
    }

    //user contact page
    public function contact(){
        $cart = Cart::get();
        return view('user.contact',compact('cart'));
    }

    public function contactCreate(Request $request){
        $contact = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'message' => $request->message
        ];

        Contact::create($contact);
        return back()->with(['message' => 'Sent successfully']);
    }

}

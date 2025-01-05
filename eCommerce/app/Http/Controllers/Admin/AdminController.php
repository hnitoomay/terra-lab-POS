<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\PaymentHistories;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home(){
        $totalSale = PaymentHistories::sum('total_amt');
        $totalOrder = Order::where('status',0)->count('status');
        $user = User::where('role','user')->count();
        $contact = Contact::count();
        // dd($totalOrder);
        return view('admin.home', compact('totalSale','totalOrder','user','contact'));
    }

    public function userList(){
        $user = User::where('role','user')->get();
        return view('admin.userList',compact('user'));
    }

    public function saleList(){
        $sale = Order::select('orders.created_at as order_date','payment_histories.*')
        ->leftJoin('payment_histories','payment_histories.order_code','orders.order_code')
        ->groupBy('order_code')
        ->orderBy('id','desc')
                ->get();

                $sale->each(function ($item) {
                    $item->order_date = Carbon::parse($item->order_date);
                });

        $totalSale = PaymentHistories::sum('total_amt');
                //dd($sale->toArray());
        return view('admin.sale',compact('sale','totalSale'));
    }

    public function contactList(){
        $contact = Contact::select('contacts.*','users.name as user_name','users.phone as user_phone','users.profile as user_profile')
        ->leftJoin('users','contacts.user_id','users.id')
        ->get();
        return view('admin.contactList', compact('contact'));
    }
}

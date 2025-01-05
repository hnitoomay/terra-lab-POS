<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productDetail($id){

        //for single product detail and related list
        $product =
            Product::select('products.*', 'categories.name as category_name')
        ->leftJoin('categories','products.category_id', 'categories.id')
        ->where('products.id',$id)
        ->first();

        $relateProduct = Product::select('products.*', 'categories.name as category_name')
        ->leftJoin('categories','products.category_id', 'categories.id')
        ->get();

        $cart = Cart::get();

        $comment = Comment::select('comments.*','users.name as user_name','users.profile as user_profile')
                    ->leftJoin('users','users.id','comments.user_id')
                    ->where('product_id',$id)->get();

        $rating = Rating::where('product_id',$id)->avg('count');
        $rating = $rating !== null ? (float)$rating : 0;
        //dd($rating);

        $userRating = Rating::where('user_id',Auth::user()->id)->where('product_id',$id)->first('count');

        $userRating = $userRating == null ? 0 : $userRating['count'];
        //dd($userRating);

        //action log
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'action' => 'seen'
        ]);

        // $viewCount = ActionLog::where('product_id',$id)->where('action','seen')->count();
        // dd($viewCount);
        $viewCount = ActionLog::where('product_id',$id)->where('action','seen')->get();
        $viewCount = count($viewCount);
        //dd($viewCount);

        return view('user.productDetail', compact('product','relateProduct','cart','comment','rating','userRating','viewCount'));
    }



}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList(){
        $product = Product::get();

        return response()->json($product, 200);
    }

    public function productCreate(Request $request){
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products','public');
        };

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'photo' => $path ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Product::create($data);
        return response()->json($response, 200);
    }

    public function productDelete(Request $request){
        $data = Product::where('id',$request->id)->first();

        if (isset($data)) {
            Product::where('id',$request->id)->delete();
            return response()->json(['status' => true, 'message' => 'deleted'], 200);
        }
        return response()->json(['status' => false, 'message' => 'not found'], 200);
    }

    public function productUpdate(Request $request) {

        $product = Product::where('id',$request->id)->first();

        if ($request->hasFile('photo')) {

            if (Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }

            $path = $request->file('photo')->store('products','public');
        }else {
            $path = $product->photo; // Retain the old photo if no new one is uploaded
        };

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $path
        ];



        $response = Product::where('id', $request->id)->first();
        //return $response;

        if(isset($response)) {
            Product::where('id',$request->id)->update($data);
            return response()->json(['status' => true, 'message' => 'updated',$response], 200);
        }

        return response()->json(['status' => false, 'message' => 'failed'], 200);
    }
}

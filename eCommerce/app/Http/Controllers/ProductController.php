<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createForm(){
        $category = Category::select('id','name')->get();
        return view('admin.product.product', compact('category'));
    }

    public function productList($amt = 'default'){
       // dd($amt);

        $product = Product::select('products.*', 'categories.name as category_name')
        ->leftJoin('categories','products.category_id', 'categories.id')
        ->when(request('key'),  function($query){
            $query -> whereAny(['products.name','categories.name'],'like','%'.request('key').'%');
        });

        if($amt != 'default'){
            $product = $product-> where('stock','<=',3);
        }
        $product = $product->orderBy('id','desc')->paginate(7);
       // dd($product->toArray());
        return view('admin.product.list',compact('product'));
    }

    public function productCreate(Request $request){
        $this->getValidateData($request,null,'create');
       // dd($request->all());
       $data = $this->getRequestData($request);

       if($request->hasFile('photo')){
            $newfile = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path(). '/image',$newfile);
            $data['photo'] = $newfile;
       }
       Product::create($data);
       return redirect()->route('product#list')->with(['createMessage' => 'created']);
    }

    public function productDelete($id){
        Product::find($id)->delete();
        return back();
    }

    public function productEdit($id){
        $category = Category::select('id','name')->get();
        $products = Product::where('id',$id)->first();
        return view('admin.product.edit', compact('products','category'));
    }

    public function productUpdate(Request $request,$id){
        $this->getValidateData($request,$id,'update');
        $updateData = $this->getRequestData($request);

        if($request->hasFile('photo')){

            if(file_exists(public_path('image/'.$request->photo))){
                unlink(public_path('image/'.$request->photo));
            }

            $newfile = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path(). '/image',$newfile);
            $updateData['photo'] = $newfile;
       }
       Product::where('id',$id)->update($updateData);
       return redirect()->route('product#list')->with(['updateMessage' => 'updated','updateID' => $id]);

    }
    private function getRequestData($request){
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category,
            'stock' => $request->stock
        ];
    }

    private function getValidateData($request,$id = null,$action){
        $rules = [
            'name' => 'required|unique:products,name,'.$id,
            'price' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric|min:0|max:99',
            'description' => 'required'
        ];

        $rules['photo'] = $action == 'create'?  'required|mimes:png,jpg,svg,webp,jpeg|file':  'mimes:png,jpg,svg,webp,jpeg|file';

        $request->validate($rules);
    }
}

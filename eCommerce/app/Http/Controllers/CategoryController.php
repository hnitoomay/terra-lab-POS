<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function categoryList(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.category.list',compact('category'));
    }

    //create
    public function categoryCreate(Request $request){
        //dd($request->all());
        $this->getValidateData($request);
        $data = $this->getRequestData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['insertMessage' => 'Created']);

    }

    //delete
    public function categoryDelete($id){
        Category::find($id)->delete();
        return back()->with(['deleteMessage' => 'Deleted','deleteID' => $id]);
    }

    //edit
    public function categoryEdit($id){
        $categories = Category::where('id', $id)->first();
       //dd($categories->name);
       return view('admin.category.update', compact('categories'));
    }

    //update
    public function categoryUpdate(Request $request, $id){
        $this->getValidateData($request);
        $updateData = $this->getRequestData($request);
        //dd($updateData);
        Category::find($id)->update($updateData);
        return redirect()->route('category#list')->with(['updateMessage' => 'Updated','updateID' => $id]);
    }

    private function getRequestData($request){
        return [
            'name' => $request->category,
        ];
    }

    private function getValidateData($request){
        Validator::make($request->all(),[
            'category' => 'required',
        ])->validate();
    }

}

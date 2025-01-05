<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function userProfile(){
        $cart = Cart::get();
        return view('user.profile.profile',compact('cart'));
    }

    public function edit(){
    $cart = Cart::get();
        return view('user.profile.profileEdit',compact('cart'));
    }

    public function update(Request $request){
        $this->getValidateAccount($request);
        $updateData = $this->getRequestData($request);
        //dd($updateData);
        if($request->hasFile('profile')){
            //delete old file
            if(auth::user()->profile != null){
                if(file_exists(public_path('image/'.auth::user()->profile))){
                    unlink(public_path('image/'.auth::user()->profile));
                }
            }
            $newfile = uniqid().'_'.$request->file('profile')->getClientOriginalName();

            $request->file('profile')->move(public_path(). '/image',$newfile );
            $updateData['profile'] = $newfile;
        };
        User::where('id',Auth::user()->id)->update($updateData);
        return back();
    }

    private function getRequestData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'addrress' => $request->address,
        ];

    }

    private function getValidateAccount($request){
        $request -> validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|unique:users,phone,'.Auth::user()->id,
            'profile' => 'mimes:jpg,jpeg,webp,png,svg|file'
        ]);
    }

    public function password(){
        $cart = Cart::get();
        return view('user.profile.password',compact('cart'));
    }

    public function passwordUpdate(Request $request){
        $this->passwordValidation($request);
        $db_password = Auth::user()->password;
        if (Hash::check($request->oldPassword, $db_password)) {
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with(['updateSuccess' => 'updated successfully']);
        }
        return back()->with(['updateFail' => 'failed updating']);
    }

    private function passwordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'password-confirmation' => 'required|same:newPassword'
        ]);
    }
}

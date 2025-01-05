<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function password(){

        return view('admin.profile.password');
    }

    public function passwordChange(Request $request){
        //dd($request->all());
        $this->getValidateData($request);
       $dbPassword = Auth::user()->password;
       if(Hash::check( $request->oldPassword ,$dbPassword)){
            User::where('id',Auth::user()->id)->update([

                'password' => Hash::make($request->newPassword)
            ]);
            return back()->with(['updateSuccess' => 'updated']);
       }
         return back()->with(['updateFail' => 'Old password not match']);
    }

    public function accountInfo(){
        return view('admin.profile.account');
    }

    public function accountEdit(){
        return view('admin.profile.accountEdit');
    }

    public function accountUpdate(Request $request){
        $this -> getValidateAccount($request);
        //dd($request->all());
        $updateData = $this->getRequestData($request);
        //dd($updateData)->toArray();

        if($request->hasFile('profile')){

            if(Auth::user()->profile != null){
                if(file_exists(public_path('image/'.Auth::user()->profile))){
                    unlink(public_path('image/'.Auth::user()->profile));
                }
            }

            $filename = uniqid().'_'.$request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path(). '/image',$filename);
            $updateData['profile'] = $filename;

        }else{
            $updateData['profile'] = Auth::user()->profile;
        }

        User::where('id',Auth::user()->id)->update($updateData);
        return redirect()->route('account');
    }

    private function getValidateData($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'password-confirmation' => 'required|same:newPassword',
        ]);
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

    //junior admin
    public function adminJr(){
        return view('admin.accountJr.accountJr');
    }

    //create jr admin
    public function adminJrCreate(Request $request){
        //dd($request->all());
        $this->getValidateJrAdmin($request);
        $data = $this->getRequestJr($request);
        //dd($data);
        User::create($data);
        return back()->with(['insertMessage' => 'Created']);
    }

    //jr admin list show
    public function adminJrList(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
            ->orWhere('addrress','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%');
        })
            ->select('id','name','email','phone','addrress','profile','created_at')

                ->where('role','admin')
                ->orWhere('role','adminJr')

                ->get();
        return view('admin.accountJr.adminJrList',compact('admin'));
    }

    //admin jr delete
    public function adminJrDelete($id){
        User::find($id)->delete();
        return back();
    }

    private function getRequestJr($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->newPassword),
            'role' => 'adminJr'
        ];
    }

    private function getValidateJrAdmin($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'newPassword' => 'required|min:6',
            'password-confirmation' => 'required|same:newPassword'
        ]);
    }
}

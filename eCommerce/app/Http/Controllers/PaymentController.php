<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class PaymentController extends Controller
{
    public function paymentList(){
        $payment = Payment::orderBy('id','desc')->get();
        return view('admin.payment.payment',compact('payment'));
    }

    public function paymentCreate(Request $request){
        //dd($request->all());
        $this->getValidateData($request);
        $data = $this->getRequestData($request);
        //dd($data);
        Payment::create($data);
        return back()->with(['insertMessage' => 'created']);
    }

    public function paymentDelete($id){
        Payment::where('id',$id)->delete();
        return back();
    }

    private function getRequestData($request){
        $data = [
            'account_number' => $request->accnumber,
            'account_name' => $request->accname,
            'account_type' => $request->acctype
        ];
        return $data;
    }

    private function getValidateData($request){
        $request->validate([
            'accnumber' => 'required',
            'accname' => 'required',
            'acctype' => 'required',
        ]);
    }
}

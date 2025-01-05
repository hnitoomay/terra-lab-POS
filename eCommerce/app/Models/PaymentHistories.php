<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistories extends Model
{
    protected $fillable = ['user_name','phone','address','payslip_image','payment_method','order_code','total_amt'];
}

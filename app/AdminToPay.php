<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminToPay extends Model
{
    protected $table = 'admin_to_pay';
    protected $fillable = [
        'seller_id',
        'user_id',
        'amount',
        'order_detail',
        'status',
        'paid_date',
        'payment_type',
    ];

    public function orderDetail(){
    	return $this->hasOne(OrderDetail::class,'id','order_detail')->with('order');
    }
}

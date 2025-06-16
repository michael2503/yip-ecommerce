<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'product_info',
        'total_amount',
        'shipping_fee',
        'payment_method',
        'country',
        'state',
        'postal_code',
        'address',
        'phone',
        'status'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

}

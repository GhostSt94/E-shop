<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'user_id',
        'fname',
        'lname',
        'address1',
        'address2',
        'email',
        'phone',
        'city',
        'country',
        'pin_code',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'tracking_no',
        'total_price'
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}

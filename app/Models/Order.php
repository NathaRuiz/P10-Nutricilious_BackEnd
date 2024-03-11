<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_order(){
        return $this->hasMany(Product_Order::class, 'order_id');
    }
}

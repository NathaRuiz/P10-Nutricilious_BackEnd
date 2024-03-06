<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_order(){
        return $this->hasMany(Product_Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_userCompany');
    }

};

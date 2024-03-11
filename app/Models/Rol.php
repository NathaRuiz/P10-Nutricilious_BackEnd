<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rols';
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
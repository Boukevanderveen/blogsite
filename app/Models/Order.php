<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

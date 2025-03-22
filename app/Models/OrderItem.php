<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Orders;
use App\Models\Products;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orderitem';

    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
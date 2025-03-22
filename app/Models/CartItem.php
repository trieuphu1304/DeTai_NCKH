<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    
    protected $fillable = [
        'cart_id',
        'products_id',
        'quantity',
        'price',
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
    
    public function product() {
        return $this->belongsTo(Products::class);
    }
}
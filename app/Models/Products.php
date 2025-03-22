<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;  

    protected $table = 'products';  

    protected $fillable = [
        'name',
        'description',
        'price',
        'price_sale',
        'image',
        'quantity',
        'productcategory_id',  
    ];

    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'productcategory_id');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
}
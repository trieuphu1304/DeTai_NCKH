<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';

    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}
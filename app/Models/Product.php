<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Add 'image' to the fillable property
    protected $fillable = [
        'image', // Allow mass assignment for the 'image' field
        'product_code',
        'name',
        'category',
        'stock',
        'price',
    ];
}

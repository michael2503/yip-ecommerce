<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'old_price',
        'sales_price',
        'quantity',
        'sold',
        'sku',
        'brand',
        'image',
        'description'
    ];


}

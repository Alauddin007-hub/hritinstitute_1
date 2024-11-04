<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'images', 'price', 'quantity', 'vendor_id'
    ];

    protected $casts = [
        'images' => 'array', 
    ];


    //  id
    //   Product name
    //   Product description
    //   Multiple Image
    //   Price
    //   Quantity
    //   Vendor id
}

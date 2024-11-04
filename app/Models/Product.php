<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'images', 'price', 'quantity', 'vendor_id'
    ];

    protected $casts = [
        'images' => 'array', // Enables storage and retrieval as an array
    ];


    //  id
    //   Product name
    //   Product description
    //   Multiple Image
    //   Price
    //   Quantity
    //   Vendor id
}

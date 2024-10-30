<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'category_id',
        'vendor_id',
    ];


    //  id
    //   Product name
    //   Product description
    //   Multiple Image
    //   Price
    //   Quantity
    //   Vendor id
}

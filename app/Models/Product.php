<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'images', 'price', 'quantity', 'vendor_id','category_id'
    ];

    protected $casts = [
        'images' => 'array', // Enables storage and retrieval as an array
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // public function reviews() {
    //     return $this->hasMany(Review::class);
    // }

    // public function orders() {
    //     return $this->hasMany(Order::class);
    // }

    //  id
    //   Product name
    //   Product description
    //   Multiple Image
    //   Price
    //   Quantity
    //   Vendor id
}

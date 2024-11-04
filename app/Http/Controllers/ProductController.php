<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $cats = Category::all();
        return view('admin.product.create', compact('cats'));
    }

    public function store(Request $request)
    {
        dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'vendor_id' => 'required|exists:vendors,id',
        ]);
    
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }
    
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'images' => $imagePaths,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'vendor_id' => $request->vendor_id,
        ]);
    
        return back()->with('success', 'Product created successfully!');

    }

    public function edit($id)
    { 

    }

    public function update(Request $request)
    {
        $data = $request->all();
        dd($data);
    }

    public function destroy()
    {

    }



    public function stocks()
    {

    }
}

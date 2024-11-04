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

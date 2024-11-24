<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }

        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
        ];

        session(['cart' => $cart]);

        return response()->json(['status' => 'success', 'message' => 'Product added to cart']);
    }

    public function view()
    {
        $cart = session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json(['status' => 'success', 'data' => $products]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'data' => $products,
        ], Response::HTTP_OK);
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('products'), $imageName);
                $imagePaths[] = 'products/' . $imageName;
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'images' => json_encode($imagePaths),
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully!',
            'data' => $product,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePaths = json_decode($product->images, true) ?? [];
        if ($request->hasFile('images')) {
            foreach ($imagePaths as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('products'), $imageName);
                $imagePaths[] = 'products/' . $imageName;
            }
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'images' => json_encode($imagePaths),
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully!',
            'data' => $product,
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], Response::HTTP_NOT_FOUND);
        }

        foreach (json_decode($product->images, true) as $imagePath) {
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully!',
        ], Response::HTTP_OK);
    }

    
    public function stocks()
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'data' => $products->map(function ($product) {
                return [
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                ];
            }),
        ], Response::HTTP_OK);
    }
}

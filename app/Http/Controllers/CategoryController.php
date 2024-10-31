<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required|max:150',
        ]);

        if ($validated) {

            $data = [
                'name' => $request->name,
                'short_description' => $request->description,
            ];

            // dd($data);
            Category::create($data);
            return redirect('/categories')->with('success', "Category has been added");
        }
    }

    public function edit($id)
    {
        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required|max:150',
        ]);

        if ($validated) {

            $data = [
                'name' => $request->name,
                'short_description' => $request->description,
            ];

            // dd($data);
            $cat = Category::find($request->id);
            $cat->update($data);
            return redirect('/categories')->with('success', "Category has been added");
        }
    }

    public function destroy(Request $request)
    {
        $cat = Category::find($request->id);
        $cat->delete();
        return back()->with('success', "Category has been deleted");
    }
}

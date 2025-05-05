<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/products/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
        }

        // Create product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'image' => $imagePath ? asset('storage/' . $imagePath) : null,
        ]);

        $category = Category::find($request->category);

        return response()->json([
            'success' => 'Product added successfully!',
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category' => $category->categoryname,
                'category_id' => $product->category_id,
                'image' => $product->image,
                'index' => $product->id
            ]
        ]);
    }

    /**
     * Get product data for editing
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                $oldPath = str_replace(asset('storage/'), '', $product->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/products/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $product->image = asset('storage/' . $imagePath);
        }

        // Update product details
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->save();

        // Get category name for response
        $category = Category::find($request->category);

        return response()->json([
            'success' => 'Product updated successfully!',
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category' => $category->categoryname,
                'category_id' => $product->category_id,
                'image' => $product->image
            ]
        ]);
    }

    /**
     * Remove the specified product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if exists
        if ($product->image) {
            $imagePath = str_replace(asset('storage/'), '', $product->image);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $product->delete();

        return response()->json([
            'success' => 'Product has been deleted successfully!'
        ]);
    }
}
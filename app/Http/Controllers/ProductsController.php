<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\ProductsModel;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class ProductsController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = ProductsModel::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
   {
   
       $request->validate([
           'name' => 'required|min:1|max:10',
           'price' => 'required',
           'description' => 'required|string',
           'category' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
      
        
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/products/' . $name_gen));
            
            $save_url = 'Upload/products/' . $name_gen;
            
            $product = ProductsModel::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
                'image' => $save_url,
            ]);
            
            return response()->json([
                'success' => 'Product saved successfully.',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'category' => category::where('id',$request->category)->value('categoryname'),
                    'image' => asset($product->image),
                    ]
                ]);
            }
            
            return response()->json(['error' => 'Image upload failed.'], 422);
        }


public function edit($id)
        {
       $product = ProductsModel::findOrFail($id);
       
       return response()->json([
           'product' => $product
        ]);
    }
    
    // Update a product by its ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:10',
            'description' => 'required|string',
            'price' => 'required',
           'category' => 'required',

            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);      
       $product = ProductsModel::findOrFail($id);
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        
        
        if ($request->hasFile('image')) {
           $manager = new ImageManager(new Driver());
   
           if ($product->image && Storage::exists($product->image)) {
               Storage::delete($product->image);
           }

           if ($product->image) {
               $imagePath = public_path($product->image);
       
               if (File::exists($imagePath)) {  
                   File::delete($imagePath);
               } else {
                   
               }
           } 
   
           $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
           $img = $manager->read($request->file('image'));
           $img->resize(800, 400);
           $img->save(public_path('Upload/products/' . $name_gen));
   
           $save_url = 'Upload/products/' . $name_gen;
           $product->image = $save_url;
       }
   
       $product->save();
       return response()->json([
           'success' => 'Product updated successfully.',
           'product' => [
               'id' => $product->id,
               'name' => $product->name,
               'description' => $product->description,
               'price' => $product->price,
               'category' => category::where('id',$request->category)->value('categoryname'),
               'image' => asset($product->image),
           ]
       ]);
   }
   
   public function destory($id)
   {
       $product = ProductsModel::findOrFail($id);
       
       // Delete the image file if it exists
       if ($product->image) {
           $imagePath = public_path($product->image);
           
           if (File::exists($imagePath)) {
               File::delete($imagePath);
           }
       }
       
       // Delete the product
       $product->delete();
       
       return response()->json([
           'success' => 'Product deleted successfully.'
       ]);
   }

   
}
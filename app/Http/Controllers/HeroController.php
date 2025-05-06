<?php

namespace App\Http\Controllers;

use App\Models\hero;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class HeroController extends Controller
{
   public function hero(){
    $heros = hero::latest()->get();

    return view('admincomponents.hero',compact('heros'));
   }

   public function store(Request $request)
    {
      

        $request->validate([
            'description' => 'required',
            'title'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
       
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
    
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
    
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/Banner/' . $name_gen));
    
            $save_url = 'Upload/Banner/' . $name_gen;
    
            $hero = hero::create([

                'description' => $request->description,
                'title'=>$request->title,
                'url' => $save_url,
            ]);
    
            return response()->json([
                'success' => 'Product saved successfully.',
                'hero' => [
                    'id' => $hero->id,
                    'description' => $hero->description,
                    'title'=> $hero->title,
                    'status' =>'0',
                    'image' => asset($hero->url),
                ]
            ]);
        }
    
        return response()->json(['error' => 'Image upload failed.'], 422);
    }

    // Edit a product by its ID
    public function edit($id)
    {
        $hero = hero::findOrFail($id);
    
        return response()->json([
            'hero' => $hero
        ]);
    }
    
    // Update a product by its ID
    public function update(Request $request, $id)
    {
        $request->validate([

            'description' => 'required',
            'title'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $hero = hero::findOrFail($id);

        $hero->description = $request->description;
        $hero->title = $request->title;
    
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
    
            if ($hero->image && Storage::exists($hero->image)) {
                Storage::delete($hero->image);
            }

            if ($hero->image) {
                $imagePath = public_path($hero->image);
        
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                } else {
                    
                }
            } 
    
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/Banner/' . $name_gen));
    
            $save_url = 'Upload/Banner/' . $name_gen;
            $hero->image = $save_url;
        }
    
        $hero->save();
    
        return response()->json([
            'success' => 'Product updated successfully.',
            'hero' => [
                'id' => $hero->id,  
                'title'=> $hero->title,        
                'description' => $hero->description,
                'status' =>'0',
                'image' => asset($hero->image),
            ]
        ]);
    }


    public function delete($id)
    {
        $hero = hero::find($id);
    
        if (!$hero) {
            // Log::error("Product not found with ID: $id");
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        // Log::info("Found product: " . $product->name);
    
        if ($hero->image) {
            $imagePath = public_path($hero->image);
    
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                // Log::info("Image deleted at: $imagePath");
            } else {
                // Log::warning("Image not found at: $imagePath");
            }
        } else {
            // Log::warning("No image field for product: $id");
        }
    
        $hero->delete();
        // Log::info("Product deleted: $id");
    
        return response()->json(['success' => 'Product deleted successfully']);
    }


    public function toggleStatus(Request $request, $id)
    {
        $status = $request->status;
    
        // First, deactivate all heroes
        Hero::where('id', '!=', $id)->update(['status' => 0]);
    
        // Then activate the selected one
        $hero = Hero::findOrFail($id);
        $hero->status = $status;
        $hero->save();
    
        return response()->json([
            'message' => $status ? 'This hero is now active. Others deactivated.' : 'Hero is now inactive.'
        ]);
    }
    

}

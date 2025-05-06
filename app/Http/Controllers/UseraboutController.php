<?php

namespace App\Http\Controllers;

use App\Models\Userabout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
class UseraboutController extends Controller
{
 

    public function index() {
        $posts = Userabout::all();
        return view('admincomponents.about', compact('posts'));
    }

    public function create() {
        return view('admincomponents.about');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('Upload/about'); // → this is /public/Upload/about
            $image->move($destinationPath, $filename);
            $imagePath = 'Upload/about/' . $filename; // Relative path for asset()
        }
    
        Userabout::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        return redirect('/about')->with('success', 'Post created successfully!');
    }
    

    public function edit($id) {
        $post = Userabout::findOrFail($id);
        $posts = Userabout::latest()->get();
        return view('admincomponents.about',  compact('post', 'posts'))->with('edit', true);
    }

    public function update(Request $request, $id) {
        $post = Userabout::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $imagePath = $request->file('image')->store('Upload/about', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect('/about');
    }

    public function delete($id) {
        $post = Userabout::findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();
        return redirect('/about');
    }
}


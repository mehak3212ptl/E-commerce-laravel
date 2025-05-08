<?php

namespace App\Http\Controllers;


use App\Models\FooterSection;

use App\Models\QuickLink;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
    /**
     * Display a listing of the footer sections.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutSection = FooterSection::where('section_type', 'about_info')->first();

        $quickLinks = QuickLink::orderBy('display_order')->get();
        $contactSection = FooterSection::where('section_type', 'contact')->first();
        $galleryImages = GalleryImage::orderBy('display_order')->get();

        return view('admincomponents.footer.index', compact(
            'aboutSection',
            'quickLinks',
            'contactSection',
            'galleryImages'
        ));
    }

    /**
     * Show the form for creating a new footer section.
     *
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('admincomponents.footer.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->type;

        switch ($type) {
            case 'about_info':
            case 'contact':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                FooterSection::updateOrCreate(
                    ['section_type' => $type],
                    [
                        'title' => $request->title,
                        'content' => $request->content,
                        'is_active' => $request->has('is_active'),
                    ]
                );

                $message = ucfirst(str_replace('_', ' ', $type)) . ' updated successfully';
                break;

            case 'quick_link':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'url' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                QuickLink::create([
                    'title' => $request->title,
                    'url' => $request->url,
                    'is_active' => $request->has('is_active'),
                    'display_order' => QuickLink::count() + 1,
                ]);

                $message = 'Quick link added successfully';
                break;

            case 'gallery':
                $validator = Validator::make($request->all(), [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'alt_text' => 'nullable|string|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('Upload/footer'), $imageName);
                    
                    $imagePath = 'Upload/footer/' . $imageName;

                    GalleryImage::create([
                        'image_path' => $imagePath,
                        'alt_text' => $request->alt_text ?? 'Gallery Image',
                        'is_active' => $request->has('is_active'),
                        'display_order' => GalleryImage::count() + 1,
                    ]);

                    $message = 'Gallery image added successfully';
                } else {
                    return redirect()->back()->with('error', 'Image upload failed');
                }
                break;

            default:
                return redirect()->back()->with('error', 'Invalid section type');
        }

        return redirect(url('admin/footer/'))->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $id = null)
    {
        switch ($type) {
            case 'about_info':
            case 'contact':
                $section = FooterSection::where('section_type', $type)->first();
                return view('admincomponents.footer.edit', compact('section', 'type'));
                break;

           

            case 'quick_link':
                $quickLink = QuickLink::findOrFail($id);
                return view('admincomponents.footer.edit', compact('quickLink', 'type'));
                break;

            case 'gallery':
                $galleryImage = GalleryImage::findOrFail($id);
                return view('admincomponents.footer.edit', compact('galleryImage', 'type'));
                break;

            default:
                return redirect()->back()->with('error', 'Invalid section type');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $id = null)
    {
        switch ($type) {
            case 'about_info':
            case 'contact':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                FooterSection::updateOrCreate(
                    ['section_type' => $type],
                    [
                        'title' => $request->title,
                        'content' => $request->content,
                        'is_active' => $request->has('is_active'),
                    ]
                );

                $message = ucfirst(str_replace('_', ' ', $type)) . ' updated successfully';
                break;


            case 'quick_link':
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|max:255',
                    'url' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $quickLink = QuickLink::findOrFail($id);
                $quickLink->update([
                    'title' => $request->title,
                    'url' => $request->url,
                    'is_active' => $request->has('is_active'),
                ]);

                $message = 'Quick link updated successfully';
                break;

            case 'gallery':
                $validator = Validator::make($request->all(), [
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'alt_text' => 'nullable|string|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $galleryImage = GalleryImage::findOrFail($id);

                if ($request->hasFile('image')) {
                    // Delete old image
                    if (Storage::disk('public')->exists($galleryImage->image_path)) {
                        Storage::disk('public')->delete($galleryImage->image_path);
                    }

                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('Upload/footer'), $imageName);
                    
                    $imagePath = 'Upload/footer/' . $imageName;
                    $galleryImage->image_path = $imagePath;
                }

                $galleryImage->alt_text = $request->alt_text ?? 'Gallery Image';
                $galleryImage->is_active = $request->has('is_active');
                $galleryImage->save();

                $message = 'Gallery image updated successfully';
                break;

            default:
                return redirect()->back()->with('error', 'Invalid section type');
        }

        return redirect(url('admin/footer/'))->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        switch ($type) {
            

            case 'quick_link':
                $item = QuickLink::findOrFail($id);
                break;

            case 'gallery':
                $item = GalleryImage::findOrFail($id);
                // Delete the image file
                if (file_exists(public_path($item->image_path))) {
                    unlink(public_path($item->image_path));
                }
                break;

            default:
                return redirect()->back()->with('error', 'Invalid section type');
        }

        $item->delete();

        return redirect(url('admin/footer/'))->with('success', ucfirst(str_replace('_', ' ', $type)) . ' deleted successfully');
    }

    /**
     * Update the display order of items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'items' => 'required|array',
            'items.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $type = $request->type;
        $items = $request->items;

        foreach ($items as $order => $id) {
            switch ($type) {
               

                case 'quick_link':
                    QuickLink::where('id', $id)->update(['display_order' => $order + 1]);
                    break;

                case 'gallery':
                    GalleryImage::where('id', $id)->update(['display_order' => $order + 1]);
                    break;
            }
        }

        return response()->json(['success' => 'Order updated successfully']);
    }
}

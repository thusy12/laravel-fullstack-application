<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageFile = $request->file('image');
        $timestamp = now()->format('Y_m_d_His');  // Format: Year_Month_Day_HourMinuteSecond
        $extension = $imageFile->getClientOriginalExtension();  // Get the file extension
        $fileName = "image_{$timestamp}.{$extension}";  // Combine to create a unique name

        $manager = new ImageManager(new Driver());

        // Resize Image
        $image = $manager->read($imageFile)->resize(800, 600); // Resize to 800x600
        $imagePath = "images/{$fileName}";

        // Save to Storage
        Storage::disk('public')->put($imagePath, $image->encode());

        // Save Image Path to Database
        auth()->user()->images()->create(['file_path' => $imagePath]);

        return back()->with('success', 'Image resized and uploaded successfully!');
    }

    public function index()
    {
        $images = auth()->user()->images()->orderBy('created_at', 'desc')->paginate(12);
        return view('contributor.images', compact('images'));
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete(); // Soft delete
        return back()->with('error', 'Image deleted successfully.');
    }

}

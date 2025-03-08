<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $timestamp = now()->format('Y_m_d_His');  // Format: Year_Month_Day_HourMinuteSecond
        $extension = $request->file('image')->getClientOriginalExtension();  // Get the file extension
        $fileName = "image_{$timestamp}.{$extension}";  // Combine to create a unique name

        // Store the image in the 'images' folder in public storage
        $path = $request->file('image')->storeAs('images', $fileName, 'public');

        auth()->user()->images()->create(['file_path' => $path]);

        return back()->with('success', 'Image uploaded successfully!');
    }

    public function index()
    {
        $images = auth()->user()->images;
        return view('contributor.images', compact('images'));
    }

}

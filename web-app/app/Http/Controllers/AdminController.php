<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImageApprovalMail;

class AdminController extends Controller
{
    public function index()
    {
        $images = Image::where('status', 'pending')->latest()->paginate(5);
        return view('admin.images', compact('images'));
    }

    public function update(Image $image, $status)
    {
        $image->update(['status' => $status]);

        try {
            // Send email notification
            Mail::to($image->user->email)->send(new ImageApprovalMail($image));
        } catch (\Exception $e) {
            return back()->with('warning', 'Image status updated, but email notification failed.');
        }
    
        // Return message to be displayed on the frontend
        if ($status == 'approved') {
            return back()->with('success', 'Image approved!');
        } else {
            return back()->with('success', 'Image denied!');
        }
    }
}

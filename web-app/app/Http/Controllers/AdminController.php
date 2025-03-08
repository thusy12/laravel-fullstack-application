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
        $images = Image::where('status', 'pending')->get();
        return view('admin.images', compact('images'));
    }

    public function update(Image $image, $status)
    {
        $image->update(['status' => $status]);

        // Send email notification
        Mail::to($image->user->email)->send(new ImageApprovalMail($image));

        return back()->with('success', 'Image status updated!');
    }
}

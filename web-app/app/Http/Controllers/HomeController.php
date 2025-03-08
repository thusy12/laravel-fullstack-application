<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Redirect logged-in users to dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // If not logged in, go to register page
        return redirect('/register');
    }
}

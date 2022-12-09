<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $uploads = Upload::where('user_id', $userId)->get();

        return view('gallery', ['uploads'=> $uploads]);
    }
}

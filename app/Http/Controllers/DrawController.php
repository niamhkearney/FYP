<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrawController extends Controller
{
    public function drawPage()
    {
        return view('draw_app');
    }

    // Creating a new upload from the form in draw_app
    public function newupload(Request $request)
    {
        $upload = new Upload;
        $upload->title=$request->title;
        $upload->description=$request->description;

        $imageName=$request->image;
        $imagePath=public_path('images').'/'.$imageName;

        $upload->path=$imagePath;
        $userId = Auth::id();
        $upload->user_id=$userId;
        $upload->save();
        return redirect('home');
    }
}

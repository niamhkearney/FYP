<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DrawController extends Controller
{
    public function drawPage()
    {
        return view('draw_app');
    }

    // Creating a new upload from the form in draw_app
    public function newupload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->passes()) {

            $upload = new Upload;
            $upload->title = $request->title;
            $upload->description = $request->description;

            $imgurl = $request->dataURL;

            $imgurl = str_replace('data:image/png;base64', '', $imgurl);
            $imgurl = str_replace(' ', '+', $imgurl);
            $data = base64_decode($imgurl);

            $imageName = uniqid() . '.png';
            $imagePath = public_path('images') . '/' . $imageName;

            file_put_contents($imagePath, $data);

            $upload->path = 'images/'. $imageName;
            $userId = Auth::id();
            $upload->user_id = $userId;
            $upload->save();
            return redirect('home');
        }

        return redirect('home');
    }
}

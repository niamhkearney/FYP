<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DrawController extends Controller
{
    public function drawPage()
    {
        $subject = session('subject');
        $category = session('category');
        $mins = session('mins');
        $sec = session('sec');

        //if these are both empty, hide the img carousel
        if($subject === "" && $category === "" || $subject === NULL && $category === NULL) {
            return view('draw_app',  ['timer' => ['minutes' => $mins, 'seconds' => $sec]]);
        }
        else {
            if($subject != "" || $subject != NULL) {
                $subject = 'q=' . $subject . '&';
            }

            if($category != "" || $category != NULL) {
                $category = 'category=' . $category . '&';
            }

            $getpicture = 'https://pixabay.com/api/?key=33669290-6e1b0c759f42b1ad905af4988&' . $subject . $category . 'image_type=photo&safesearch=true&per_page=5';

            $response = Http::acceptJson()->get($getpicture);
            if ($response->successful()) {

                $data = json_decode($response, true);

                if($data['total'] != 0) {
                    foreach ($data['hits'] as $elem) {
                        $values[] = $elem['webformatURL'];
                    }
                }
                else {
                    $values = 0;
                }

                return view('draw_app', ['imageinfo' => $values], ['timer' => ['minutes' => $mins, 'seconds' => $sec]]);
            }

            $response->throw();
            return redirect('home');
        }
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
            return redirect('gallery' . '/' . Auth::id());
        }

        return redirect('home');
    }

}

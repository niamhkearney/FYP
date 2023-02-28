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
        $timer = session('timer');

        if($subject != "") {
            $subject = 'q=' . $subject . '&';
        }

        if($category != "") {
            $category = 'category=' . $category . '&';
        }

        $getpicture = 'https://pixabay.com/api/?key=33669290-6e1b0c759f42b1ad905af4988&' . $subject . $category . 'image_type=photo&safesearch=true&per_page=5';

        $response = Http::acceptJson()->get($getpicture);
        if ($response->successful()) {

            $data = json_decode($response, true);

            foreach ($data['hits'] as $elem) {
                $values[] = $elem['webformatURL'];
            }

            $type = gettype($values);

            return view('draw_app', ['imageinfo' => $values]);
        }

        $response->throw();
        return redirect('home');
    }

//    public function pictureCall()
//    {
//        $subject = session('subject');
//        $category = session('category');
//        $timer = session('timer');
//
//        $getpicture = 'https://pixabay.com/api/?key=33669290-6e1b0c759f42b1ad905af4988&q=' . $subject . $category . 'image_type=photo&safesearch=true&per_page=5';
//
////        $client = new Client();
////        $headers = [
////            'Cookie' => '__cf_bm=.mZ9RPWAVvTc3D4HMrcj1lBN70LxRodX7CEx7po42qg-1676987072-0-AUApQOj20LKTuXdz1Bl83vNLUqEcsMIF9ZPA6MDC21sooT1sMOoT34T8S3pVatB9vY44xEfLti9KzSYDd1p78dM=; anonymous_user_id=None; csrftoken=gIEylq4vXwzwrjNVpbnk37m2pAky9mVu2gWvMLOMDlvU2SzymCX662oBVKWY2TDV; g_rated=permanent'
////        ];
////        $body = '';
////        $request = new Request('GET', $getpicture, $headers, $body);
////        $res = $client->sendAsync($request)->wait();
////        $res->getBody();
//
////        $response = Http::get($getpicture, [
////        ]);
//
//        $response = Http::acceptJson()->get($getpicture);
//        if ($response->successful()) {
//
//            $data = json_decode($response);
//
//            foreach ($data as $image) {
//                foreach ($image as $key => $value) {
//                    echo "$key - $value </br>";
//                }
//            }
//        }
//
//        $response->throw();
//        return redirect('home');
//    }

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
            return redirect('gallery');
        }

        return redirect('home');
    }
}

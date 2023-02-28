<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SetupController extends Controller
{
    public function setupPage()
    {
        return view('drawform');
    }

    public function formFilled(Request $request)
    {

        $subject = $request->subject;
        $category = $request->category;
        $timer = $request->timer;

        //Storing form parameters as session variables if they have not been left blank
        //Subject and Category will be used for the API GET request

        Session::put('subject', $subject);
        Session::put('category', $category);
        Session::put('timer', $timer);

        return redirect('draw');
    }
}

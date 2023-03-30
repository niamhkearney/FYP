<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index(User $user) {

        $user_uploads = Upload::where('user_id', $user->id)->get();
        $username = User::where('id', $user->id)->value('name');

        return view('gallery')
        ->with(['uploads'=> $user_uploads])
        ->with(['username'=> $username]);
    }
}

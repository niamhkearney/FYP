<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Upload;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* A controller for displaying a user's profile, referencing the profile table for their bio */

class ProfileController extends Controller
{
    //
    public function show(User $user)
    {

        //Profile information
        $userId = $user->id;
        $user_bio = Profile::where('user_id', $userId)->value('bio');

        //latest art submission
        $uploads = Upload::where('user_id', $user->id)->latest()->get();

        if(!count($uploads)) {
            $uploads = NULL;
        }

        return view('profile')
            ->with(['profile' => $user_bio])
            ->with(['latestpic' => $uploads])
            ->with(['user' => $user]);
    }

    public function edit_bio(Request $request) {

        //Checking if a row for the user bio already exists
        $existence_check = Profile::where("user_id", Auth::id())->exists();
        if($existence_check) {
            $bio_update = Profile::where("user_id", Auth::id())->get();
            $bio_update->bio = $request->new_bio;
            $bio_update->save();
        }

        $new_bio = new Profile();
        $new_bio->bio = $request->new_bio;
        $new_bio->user_id = Auth::id();
        $new_bio->save();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//This controller is for controlling the uploaded drawings, not for the upload feature... I did not think this name through

class UploadController extends Controller
{
    public function show(Upload $upload)
    {

        //getting all the comments for the upload
        $comments = Comment::select('users.name', 'comments.message', 'comments.created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('upload_id', $upload->upload_id)->get();

        //Upload information
        $userid = $upload->user_id;
        $uploader = User::where('id', $userid)->value('name');
        return view('upload')
            ->with(['upload' => $upload])
            ->with(['user' => $uploader])
            ->with(['comments' => $comments]);
    }

    public function submitComment(Request $request) {
        $comment = new Comment;
        $comment->message = $request->message;

        $userId = Auth::id();
        $uploadId = $request->uploadId;

        $comment->created_at = now();
        $comment->upload_id = $uploadId;
        $comment->user_id = $userId;
        $comment->save();

        return back();
    }
}

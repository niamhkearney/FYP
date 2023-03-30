@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
    <div id="main" class="container text-center">
        <div id="post_info">
            <img src="{{ asset($upload->path)}}" alt="Submission: {{ $upload->title }}" class=" img-fluid p-4">
            <h4><b>{{ $upload->title }}</b></h4> <br>
            @if(isset($upload->description))
            {{$upload->description}} @else <p><i>No Description</i></p> @endif <br>
            <p>By <b>{{ $user }}</b> at {{$upload->created_at}}</p>
            @if($upload->user_id === Auth::id())
                <form id="delete_upload" action="{{ route('delete_upload') }}" METHOD="POST">
                    @csrf
                    <input type="hidden" name="delete_uploadid" value="{{$upload->upload_id}}"/>
                    <button type="button" onclick="check_delete();" name="delete_button" class="btn btn-danger" value="Delete">Delete Picture</button>
                </form>
            @endif
        </div>
        <hr>
        <div id="comments_section">
            <h3><b>Comments</b></h3>
            <div id="comment">
                @if(count($comments))
                    @foreach($comments as $comment)
                        <p class="p-2">
                        <b>{{ $comment->name }}</b> - <i>{{ $comment->created_at }}</i> <br>
                        {{ $comment->message }} </p>
                    @endforeach
                @else
                    <p class ="p-2"><i>No comments... yet!</i></p>
                @endif
            </div>
        </div>
        <hr>
{{--        Make a comment--}}
        <div class="mb-3 pb-5">
            <form id="comment_form" action="{{ route('post_comment') }}" class="needs-validation" METHOD="POST" novalidate>
                @csrf
                <label for="message" class="form-label">Comment on this drawing:</label>
                <textarea class="form-control pb-2" id="message" name="message" minlength="2" maxlength="255" rows="3" required ></textarea>
                <div class="invalid-feedback">
                    Comments must have at least 2 characters!
                </div>
                <br>
                <input type="hidden" name="uploadId" value="{{$upload->upload_id}}"/>
                <button type="button" onclick="empty_comment();" name="submit_button" class="btn btn-primary" value="Submit">Submit</button>
            </form>
        </div>
    </div>
@endsection

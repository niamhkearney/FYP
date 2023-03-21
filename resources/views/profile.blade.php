@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
    <div id="main" class="container text-center">
        <div id="profile_bio">
            <h4 class="pt-3"><b>{{ $user->name }}'s Profile</b></h4> <br>
            @if($profile != NULL)
                <p>{{ $profile }}</p>
                <button class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#change_bio">Edit Bio <i class="fa-solid fa-pencil"></i>
                </button>
            @elseif($profile === NULL && Auth::user()->id == $user->id)
                <p>Your bio is empty! To set it, click the edit button.</p>
                <button class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#change_bio">Edit Bio <i class="fa-solid fa-pencil"></i>
                </button>
            @endif
            <a href="/gallery/{{ $user->id }}" target="_blank"><button type="button" class="btn btn-primary">{{ $user->name }}'s Gallery</button></a>

        </div>

        <div id="recent_upload" class="pt-5 pb-5">
            <h4>Newest Upload</h4>
            @if($latestpic != NULL)
                <a href="/posts/{{ $latestpic[0]->upload_id }}" target="_blank"><img src="{{ asset($latestpic[0]->path)}}" alt="Submission: {{ $latestpic[0]->title }}"></a>
                <h5>{{ $latestpic[0]->title }}</h5>
            @else
                <p>This user has no uploads!</p>
            @endif
        </div>

{{--            Change bio form--}}
        <div class="modal fade" id="change_bio">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User Bio</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="bioForm" class="form-container" action="{{ route('bio') }}"  METHOD="POST">
                            @csrf
                            <label for="new_bio" class="form-label"><b>New Bio:</b></label>
                            <textarea class="form-control pb-2" id="new_bio" name="new_bio" maxlength="255" rows="3" placeholder="Max 255 character" required></textarea>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" form="bioForm">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

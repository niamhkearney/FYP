@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    <div class="p-3 text-center">
        <h2>{{ $username }}'s Gallery</h2>
        <div class="pt-4 container">
            <div class="row row-cols-2">
            @foreach($uploads as $upload)
            <div class="col">
                <a href="/posts/{{ $upload->upload_id }}" target="_blank"><img src="{{ asset($upload->path)}}" alt="Submission: {{ $upload->title }}" width="300" height="250"></a>
                <h4 class="pb-4">{{ $upload->title }}</h4>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

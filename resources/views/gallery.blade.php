@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    <h2>Gallery</h2>
    @foreach($uploads as $upload)
    <div class="pt-4 container">
        <a href="/posts/{{ $upload->upload_id }}" target="_blank"><img src="{{ asset($upload->path)}}" alt="Submission: {{ $upload->title }}"></a>
        <h4>{{ $upload->title }}</h4> <br> {{$upload->description}} <br> {{$upload->created_at}}
    </div>
    @endforeach
</div>
@endsection

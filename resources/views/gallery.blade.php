@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    @foreach($uploads as $upload)
    <div class="pt-4 container">
        <img src="{{ asset($upload->path)}}" alt="Submission: {{ $upload->title }}">
        <h4>{{ $upload->title }}</h4> <br> {{$upload->description}} <br> {{$upload->created_at}}
    </div>
    @endforeach
</div>
@endsection

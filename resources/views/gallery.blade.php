@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
    <div id="main" class="container">
        @foreach($uploads as $upload)
        <div class="pt-4 container">
            {{ $upload->title }} {{$upload->description}} {{$upload->created_at}} {{$upload->user_id}}
        </div>
        @endforeach
    </div>
</body>
</html>
@endsection

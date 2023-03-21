@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    <div class="row justify-content-center">
        <div class="text-center">
            <img src="{{ asset('extra/logo_v2.png') }}" class="rounded mx-auto d-block" alt="Website logo image" >
            <h1 class="pb-2">Welcome!</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="col-md-8 container">
                    <div class="d-grid">
                        <a class="btn btn-lg btn-primary" href="{{ route('setup') }}">Start Drawing
                        </a>
                    </div>
                    <div>
                        <p class="p-3 text-center">HexSketch is a web application that allows you to draw from your browser on any device!
                            <br><br>Press the button above to start setting up your drawing environment with reference images and a countdown timer.
                        </p>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

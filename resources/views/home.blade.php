@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Welcome!</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="container">
                    <div class="d-grid">
                        <button type="button" class="p-3 btn btn-lg">Start Drawing Now!</button>
                    </div>
                    <div>
                        <p class="p-3 text-center">HexSketch is a web application that allows you to draw from your browser on any device!
                            <br>Press the button above to start!
                        </p>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

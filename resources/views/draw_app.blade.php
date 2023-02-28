@extends('layouts.app')

@section('head')
    @extends('layouts.head_draw')
@endsection

@section('content')
<div id="draw-main" class="container">
    <div class="row">
        <div class="col-8 pt-4">
            <script src="{{url('js/sketch.js')}}"></script>
            <div id="sketchCanvas">
            </div>
        </div>
        <div class="col-4 pt-4">
            <div id="demo" class="carousel carousel-dark slide" data-bs-interval="false">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://i.pinimg.com/originals/2a/0d/fc/2a0dfcb716c10ca7610126b5a6906657.jpg" alt="Los Angeles" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.pinimg.com/originals/68/77/b3/6877b3882d4474dd7a01df5237bc0669.jpg" alt="Chicago" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="https://64.media.tumblr.com/f4746901651f779dd864e43dd7b76694/tumblr_ogpbv48Q4q1v5fgk1o4_400.png" alt="New York" class="d-block w-100">
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="timer"></div>
            <script src="{{url('js/timer.js')}}"></script>
        </div>
    </div>
    <div class="row pt-4 pb-4">
        <div class="col">
            <button onclick="clearButton()" class="btn btn-lg btn-danger">Clear Canvas <i class="fa-solid fa-skull"></i></button>
            <button onclick="saveButton()" class="btn btn-lg btn-primary">Save to Device <i class="fa-solid fa-download"></i></button>
        </div>
        <div class="col">
            <button onclick="uploadButton();randomiseFormName();" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#uploadForm2">Upload <i class="fa-solid fa-file-arrow-up"></i></button>
        </div>
        <p>{{ $imageinfo[0] }}</p>
    </div>
</div>

{{--upload form--}}
<div class="modal fade" id="uploadForm2">
    <div class="modal-dialog">
        <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload your Drawing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id='uploadForm' enctype="multipart/form-data" action="{{ route('upload') }}" class="form-container" METHOD="POST">
                        @csrf
                        <label for="title" class="form-label"><b>Title:</b></label>
                        <input type="text" id="title" class="form-control" placeholder="Untitled" name="title" required><br>

                        <label for="description" class="form-label"><b>Description:</b></label>
                        <input type="text" id="description" class="form-control" placeholder="Enter Description (optional)" name="description">

                        <input type="hidden" id="myIMG" name="dataURL" value="none" />
                    </form>

                    <br><p>Warning: Once a drawing is submitted, it cannot be edited. </p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveImg" onclick="submitButt()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

@endsection

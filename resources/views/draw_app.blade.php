@extends('layouts.app')

@section('head')
    @extends('layouts.head_draw')
@endsection

@section('content')
    <div id="draw-main" >
        <div class="row">
            <div class="col-8 pt-4">
                <script src="{{url('js/sketch.js')}}"></script>
                <div id="sketchCanvas">
                </div>
            </div>
            <div class="col-4 pt-4">
                @if(isset($imageinfo) && $imageinfo != 0)
                    <div id="api_images" class="carousel carousel-dark slide" data-bs-interval="false">

                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#api_images" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#api_images" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#api_images" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#api_images" data-bs-slide-to="3"></button>
                            <button type="button" data-bs-target="#api_images" data-bs-slide-to="4"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ $imageinfo[0] }}" alt="Pixabay Image" class="d-block w-100 img-fluid">
                            </div>
                            @if(count($imageinfo) > 1)
                                @for($i = 1; $i < 4; $i++)
                                    <div class="carousel-item">
                                        <img src="{{ $imageinfo[$i] }}" alt="Pixabay" class="d-block w-100 img-fluid">
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#api_images" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#api_images" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                        <p class="text-center"><i>Images sourced from the Pixabay API</i></p>
                    </div>
                @endif
                @if(isset($imageinfo) && $imageinfo === 0)
                    <div id="api_err" class="pb-3">
                        <h4>Unfortunately, the keywords and/or categories you entered returned no results.</h4>
                        <p>Try returning to the setup form and using different keywords.</p>
                        <a class="btn btn-info" href="{{ route('setup') }}"><i class="fa-solid fa-arrow-left"></i> Back to Setup</a>
                    </div>
                @endif
                @if($timer['minutes'] && ($timer['seconds']) !== null)
                    <div class="timer">
                        <span id="showmns" class="timer_part">00</span><span class="timer_part">:</span><span
                            id="showscs" class="timer_part">00</span>
                        <button type="button" id="btnct" class="timer__btn timer_btn_start"
                                onclick="countdownTimer()">Start
                        </button>
                        <script type="text/javascript">
                            var ctmnts = {{ Js::from($timer['minutes']) }};
                            var ctsecs = {{ Js::from($timer['seconds']) }};

                            document.getElementById("showmns").textContent= ctmnts;

                            if (ctsecs < 10) {
                                document.getElementById("showscs").textContent= "0" + ctsecs;
                            }
                            else {
                                document.getElementById("showscs").textContent= ctsecs;
                            }

                            function countdownTimer() {
                                // Source: https://coursesweb.net/javascript/countdown-timer-starting-time-added-form_s2
                                if (ctmnts === 0 && ctsecs === 0) {
                                    document.getElementById('btnct').removeAttribute('disabled');     // remove "disabled" to enable the button

                                    return false;
                                } else {

                                    document.getElementById('btnct').setAttribute('disabled', "");
                                    document.getElementById("btnct").style.background = "grey";

                                    // decrease seconds, and decrease minutes if seconds reach to 0
                                    ctsecs--;

                                    if (ctsecs < 0) {
                                        if (ctmnts > 0) {
                                            ctsecs = 59;
                                            ctmnts--;
                                        } else {
                                            ctsecs = 0;
                                            ctmnts = 0;
                                        }
                                    }
                                }

                                // display the time in page, and auto-calls this function after 1 seccond
                                document.getElementById('showmns').innerHTML = ctmnts;

                                if (ctsecs < 10) {
                                    document.getElementById('showscs').innerHTML = "0" + ctsecs;
                                }
                                else {
                                    document.getElementById('showscs').innerHTML = ctsecs;
                                }
                                setTimeout('countdownTimer()', 1000);
                            }
                        </script>
                    </div>
                @endif
            </div>
        </div>
        <div class="row pt-4 pb-4">
            <div class="col">
                <button onclick="clearButton()" class="btn btn-lg btn-danger">Clear Canvas <i
                        class="fa-solid fa-skull"></i></button>
                <button onclick="saveButton()" class="btn btn-lg btn-info">Save to Device <i
                        class="fa-solid fa-download"></i></button>
            </div>
            <div class="col">
                <button class="btn btn-lg btn-success"
                        data-bs-toggle="modal" data-bs-target="#uploadForm2">Upload <i
                        class="fa-solid fa-file-arrow-up"></i>
                </button>
            </div>
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
                    <form id='uploadForm' enctype="multipart/form-data" action="{{ route('upload') }}"
                          class="form-container needs-validation" METHOD="POST" novalidate>
                        @csrf
                        <label for="title" class="form-label"><b>Title:</b></label>
                        <input type="text" id="title" class="form-control" placeholder="Untitled" name="title" required />
                        <div class="invalid-feedback">Please write a title.</div><br>

                        <label for="description" class="form-label"><b>Description:</b></label>
                        <input type="text" id="description" class="form-control"
                               placeholder="Enter Description (optional)" name="description"/>

                        <input type="hidden" id="myIMG" name="dataURL" value="none"/>
                    </form>

                    <br>
                    <p>Warning: Once a drawing is submitted, it cannot be edited. </p>
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

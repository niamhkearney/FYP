@extends('layouts.app')

@section('head')
    @extends('layouts.head_draw')
@endsection

@section('content')
<div id="main" class="container">
    <script src="{{url('js/sketch.js')}}"></script>
    <div id="sketchCanvas" class="pt-4 container">
    </div>
    <div class="container pb-4">
        <button onclick="clearButton()" class="btn">Clear Canvas</button>
        <button onclick="saveButton()" class="btn">Save Image</button>
        <div class="text-right">
            <button onclick="uploadButton();randomiseFormName();" class="btn">Upload</button>
            <div class="form-popup" id="uploadForm">
                <form action="{{ route('upload') }}" class="form-container" METHOD="POST">
                    @csrf
                    <h1>Title</h1>

                    <label for="title"><b>Title</b></label>
                    <input type="text" placeholder="Enter title" name="title" required>

                    <label for="description"><b>Description</b></label>
                    <input type="text" placeholder="Enter Description" name="description">

                    <input type="hidden" id="filename" name="image" value="random">

                    <button type="submit" id="saveImg" class="btn">Submit</button>

                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection

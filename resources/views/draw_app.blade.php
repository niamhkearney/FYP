@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')
<div id="main" class="container">
    <script src="sketch.js"></script>
    <div id="sketchCanvas" class="pt-4 container">
    </div>
    <div class="container pb-4">
        <button onclick="clearButton()" class="btn">Clear Canvas</button>
        <button onclick="saveButton()" class="btn">Save Image</button>
    </div>
</div>
</body>
</html>
@endsection

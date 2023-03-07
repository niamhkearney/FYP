@extends('layouts.app')

@section('head')
    @extends('layouts.head')
@endsection

@section('content')

<div id="main" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Before you draw.. Set up your canvas!</h2>
            <p class="text-center">If both category and subject are left blank, no reference images will be displayed.</p>
            <p class="text-center">If no value is entered for the timer, no timer will be activated.</p>
            <form class="form-container" action="{{ route('form') }}" METHOD="POST">
                @csrf
                <label for="subject" class="form-label"><b>Subject:</b></label>
                <input type="text" id="subject" class="form-control" placeholder="e.g Yellow Flowers" name="subject" value=""><br>

                <label for="category" class="form-label"><b>Choose a category:</b></label>
                <select class="form-select" name="category" aria-label="Default select example">
                    <option value="">Select a Category</option>
                    <option value="backgrounds">Backgrounds</option>
                    <option value="fashion">Fashion</option>
                    <option value="nature">Nature</option>
                    <option value="people">People</option>
                    <option value="animals">Animals</option>
                    <option value="food">Food</option>
                </select><br>

{{--                <label for="timer" class="form-label"><b>Enter number of minutes for timer:</b></label>--}}
{{--                <input type="number" id="timer" class="form-control" placeholder="e.g 6" name="timer"><br>--}}

                <div class="row">
                    <div class="col">
                        <label for="mins" class="form-label"><b>Enter number of minutes for timer:</b></label>
                        <input type="number" id="mins" class="form-control" placeholder="Minutes" value="0" name="mins">
                    </div>
                    <div class="col">
                        <label for="sec" class="form-label"><b>Enter number of seconds for timer:</b></label>
                        <input type="number" id="sec" class="form-control" placeholder="Seconds" value="0" name="sec"><br>
                    </div>
                </div>

                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
</div>

@endsection

@extends('layouts.master')

@section('content')
    <br>

    <h1>Add a schedule</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('ScheduleController@store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="day"><h3>Day</h3></label>
                <select name="day" id="day" class="form-control">
                    @foreach ($days as $day => $day_name)
                        <option value="{{ $day }}"  
                            @if (old('day') == $day) selected="selected" @endif>
                            {{ $day_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>            
            <div class="form-group">
                <label for="course_id"><h3>Course</h3></label>
                <select name="course_id" id="course_id" class="form-control">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}"  
                            @if (old('course_id') == $course->id) selected="selected" @endif>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Add Schedule</button>
        </form>

    </div>

@endsection


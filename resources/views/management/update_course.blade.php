@extends('layouts.master')

@section('content')
    <br>

    <h1>Update Course</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('CourseController@update') }}" method="post">
            {{ csrf_field() }}
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
            <br>
            <div class="form-group">
                <label for="teacher_id"><h3>Teacher</h3></label>
                <select name="teacher_id" id="teacher_id" class="form-control">
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            @if (old('teacher_id') == $teacher->id) selected="selected" @endif>
                            {{ $teacher->firstname ." ". $teacher->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>

    </div>

@endsection

@extends('layouts.master')

@section('content')
    <br>

    <h1>Add a course</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('CourseController@store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="course"><h3>Course</h3></label>
                <input type="text" name="course" id="course" class="form-control">
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
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>

    </div>

@endsection


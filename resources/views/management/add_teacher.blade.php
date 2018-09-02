@extends('layouts.master')

@section('content')
    <br>

    <h1>Select a teacher as responsible of a class</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('TeacherController@store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="class_id"><h3>Class</h3></label>
                <select name="class_id" id="class_id" class="form-control">
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}"  
                            @if (old('class_id') == $class->id) selected="selected" @endif>
                            Class {{ $class->id }}
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
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>

@endsection


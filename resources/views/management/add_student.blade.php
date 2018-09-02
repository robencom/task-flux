@extends('layouts.master')

@section('content')
    <br>

    <h1>Register a student to a class</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('RegistrationController@store') }}" method="post">
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
                <label for="student_id"><h3>Student</h3></label>
                <select name="student_id" id="student_id" class="form-control">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            @if (old('student_id') == $student->id) selected="selected" @endif>
                            {{ $student->firstname ." ". $student->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

    </div>

@endsection


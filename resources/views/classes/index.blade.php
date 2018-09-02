@extends('layouts.master')

@section('content')
    <br>

    <h1>Select a class</h1>
    <hr>

    <br>

    <form action="{{ action('ClasseController@show') }}" method="post">
        {{ csrf_field() }}
        <div class="btn-group">
            <select name="class_id" class="form-control">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">Class {{ $class->id }}</option>
                @endforeach
            </select>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection

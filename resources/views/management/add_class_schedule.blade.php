@extends('layouts.master')

@section('content')
    <br>

    <h1>Add a class schedule</h1>
    <hr>
    <br>

    <div class="col-md-4">
        <form action="{{ action('ClassScheduleController@store') }}" method="post">
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
                <label for="schedule_id"><h3>Schedule</h3></label>
                <select name="schedule_id" id="schedule_id" class="form-control">
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}"  
                            @if (old('schedule_id') == $schedule->id) selected="selected" @endif>
                            {{ $days[$schedule->day] . " - " . $schedule->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Add Schedule</button>
        </form>

    </div>

@endsection


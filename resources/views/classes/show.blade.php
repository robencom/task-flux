@extends('layouts.master')

@section('content')

        <br><br>
        <h1>Results for {{$class}}</h1>
        <hr>
        <br>

        <h2>Students</h2>
        <table border="1" style="text-align: center;">
            <tr><th>Student</th><th>Firstame</th><th>Lastname</th></tr>
            @foreach ($students as $student)
                <tr>
                    <td width="150px">{{ $student->id }}</td>
                    <td width="150px">{{ $student->firstname }}</td>
                    <td width="150px">{{ $student->lastname }}</td>
                </tr>
            @endforeach
        </table>

        <br><br>

        <br>
        <h2>Teacher</h2>

        <table border="1" style="text-align: center;">
            <tr>
                <th width="150px">Teacher</th>
                <th width="150px">Firstame</th>
                <th width="150px">Lastname</th>
                </tr>
            <tr>
                <td width="150px">{{ $teacher[0]->teacher_id }}</td>
                <td width="150px">{{ $teacher[0]->firstname }}</td>
                <td width="150px">{{ $teacher[0]->lastname }}</td>
            </tr>
        </table>

        <br><br>

        <h2>Schedule</h2>
        <table border="1" style="text-align: center;">
            @foreach ($data as $key => $schedules)
                <tr>
                    <th width="150px">{{ $days[$key] }}</th>
                    @foreach ($schedules as $sched)
                        <td width="250px">{{ $sched->name . " / " . $sched->firstname . " " . $sched->lastname }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>

@endsection

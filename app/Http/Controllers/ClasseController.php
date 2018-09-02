<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Student;
use App\Teacher;
use App\Schedule;

class ClasseController extends Controller
{

    public function index()
    {
        $students = false;
        return view('classes.index')->with('classes', Classe::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        $class = "Class " . $request->class_id;

        $days = [
                 1 => 'Monday',
                 2 => 'Tuesday',
                 3 => 'Wednesday',
                 4 => 'Thursday',
                 5 => 'Friday'
        ];

        $students = \DB::select(" SELECT r.student_id, s.id, s.firstname, s.lastname
                                  FROM registrations r INNER JOIN students s ON r.student_id = s.id 
                                  WHERE class_id=?", [$request->class_id]);

        $teacher = \DB::select("  SELECT c.teacher_id, t.firstname, t.lastname
                                  FROM classes c INNER JOIN  teachers t ON c.teacher_id = t.id
                                  WHERE  c.id=?", [$request->class_id]);

        $schedule = \DB::select(" SELECT s.day, co.name, t.firstname, t.lastname
                                  FROM classes c INNER JOIN class_schedules cs ON c.id = cs.class_id
                                                 INNER JOIN schedules s ON cs.schedule_id = s.id
                                                 INNER JOIN courses co ON co.id = s.course_id
                                                 INNER JOIN teachers t ON t.id = co.teacher_id
                                  WHERE  c.id=?
                                  ORDER BY s.day", [$request->class_id]);

        foreach($schedule as $sched) {
            if($sched->day == 1) $data[1][] = $sched;
            if($sched->day == 2) $data[2][] = $sched;
            if($sched->day == 3) $data[3][] = $sched;
            if($sched->day == 4) $data[4][] = $sched;
            if($sched->day == 5) $data[5][] = $sched;
        }

        return view('classes.show',compact('class',
                                           'students',
                                           'teacher',
                                           'days',
                                           'data'
        ));

    }

}

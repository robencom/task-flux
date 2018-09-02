<?php

namespace App\Http\Controllers;

use App\ClassSchedule;
use App\Classe;
use App\Schedule;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classes = Classe::all();

        $schedules = \DB::select(" SELECT s.id, s.day, co.name
                          FROM schedules s INNER JOIN courses co ON co.id = s.course_id
                          order by s.day"
                     );

        $days = [
                 1 => 'Monday',
                 2 => 'Tuesday',
                 3 => 'Wednesday',
                 4 => 'Thursday',
                 5 => 'Friday'
        ];

        return view('management.add_class_schedule', compact('classes', 'schedules', 'days'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messageLevel = '';
        $message = '';
        $error = false;

        foreach(ClassSchedule::all() as $classSchedule) {
            if ($classSchedule->schedule_id == $request->schedule_id && $classSchedule->class_id == $request->class_id) {
                $messageLevel = 'danger';
                $message = "This class schedule already exists!";

                $error = true;
            }
        }
        
        if (!$error) {
            try {

                $schedule = \DB::insert("INSERT INTO class_schedules (`class_id`, `schedule_id`)
                                      VALUES (?, ?)", [$request->class_id, $request->schedule_id]);

                if ($schedule == 1) {
                    $messageLevel = 'success';
                    $message = 'A new class schedule has been created successfully!';
                } else {
                    $messageLevel = 'danger';
                    $message = 'Something went wrong! Please try again later or contact the administrator!';
                }

            }
            catch (Exception $e) {
                //echo $e->getMessage();
                $messageLevel = 'danger';
                $message = 'Error. Try gain later!';

            }
            catch(\Illuminate\Database\QueryException $ex) {
                //echo $ex->getMessage();
                dd($ex->getMessage());
                $messageLevel = 'danger';
                $message = "Error. Try gain later or contact the administrator!";
            }
        }

        $request->session()->flash('message.level', $messageLevel);
        $request->session()->flash('message.content', $message);

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSchedule $classSchedule)
    {
        //
    }
}

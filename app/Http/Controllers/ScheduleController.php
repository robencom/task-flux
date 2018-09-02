<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Course;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $days = [
                 1 => 'Monday',
                 2 => 'Tuesday',
                 3 => 'Wednesday',
                 4 => 'Thursday',
                 5 => 'Friday'
        ];

        return view('management.add_schedule', compact('courses', 'days'));
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

        foreach(Schedule::all() as $schedule) {
            if ($schedule->day == $request->day && $schedule->course_id == $request->course_id) {
                $messageLevel = 'danger';
                $message = "This schedule already exists!";

                $error = true;
            }
        }
        
        if (!$error) {
            try {

                $schedule = \DB::insert("INSERT INTO schedules (`day`, `course_id`)
                                      VALUES (?, ?)", [$request->day, $request->course_id]);

                if ($schedule == 1) {
                    $messageLevel = 'success';
                    $message = 'A new schedule has been created successfully!';
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
                //dd($ex->getMessage());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

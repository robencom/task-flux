<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();

        return view('management.add_course',compact('teachers', 'classes'));
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

        foreach(Course::all() as $course) {
            if ($course->name == $request->course) {
                $messageLevel = 'danger';
                $message = "A course with the same name already exists!";

                $error = true;
            }
            // else if ($course->name == $request->course && $course->teacher_id == $request->teacher_id) {
            //     $messageLevel = 'danger';
            //     $message = "The selected teacher is already selected for another class!";

            //     $error = true;
            // }
        }
        
        if (!$error) {
            try {

                $course = \DB::insert("INSERT INTO courses (`name`, `teacher_id`)
                                      VALUES (?, ?)", [$request->course, $request->teacher_id]);

                if ($course == 1) {
                    $messageLevel = 'success';
                    $message = 'A new course has been created successfully!';
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('management.update_course',compact('teachers', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $messageLevel = '';
        $message = '';
        $error = false;

        // each teacher can be responsible for only one class
        foreach(Course::all() as $course) {
            if ($course->name == $request->course) {
                $messageLevel = 'danger';
                $message = "A course with the same name already exists!";

                $error = true;
            }
            // else if ($course->name == $request->course && $course->teacher_id == $request->teacher_id) {
            //     $messageLevel = 'danger';
            //     $message = "The selected teacher is already selected for another course!";

            //     $error = true;
            // }
        }
        
        if (!$error) {
            try {

                $course = \DB::update("UPDATE courses
                                      SET teacher_id = ?
                                      WHERE id = ?", [$request->teacher_id, $request->course_id]);

                if ($course == 1) {
                    $messageLevel = 'success';
                    $message = 'The course has been updated successfully!';
                } else {
                    $messageLevel = 'danger';
                    $message = 'The selected course has already the selected teacher!';
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

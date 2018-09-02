<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Course;
use App\Classe;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        $classes = Classe::all();

        return view('management.add_teacher',compact('teachers', 'classes'));
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
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messageLevel = '';
        $message = '';
        $error = false;

        // each teacher can be responsible for only one class
        foreach(Classe::all() as $class) {
            if ($class->teacher_id == $request->teacher_id && $class->id == $request->class_id) {
                $messageLevel = 'danger';
                $message = "The selected teacher is already selected for this class!";

                $error = true;
            }
            else if ($class->teacher_id == $request->teacher_id) {
                $messageLevel = 'danger';
                $message = "The selected teacher is already selected for another class!";

                $error = true;
            }
        }
        
        if (!$error) {
            try {

                $class = \DB::update("UPDATE classes
                                      SET teacher_id = ?
                                      WHERE id = ?", [$request->teacher_id, $request->class_id]);

                if ($class == 1) {
                    $messageLevel = 'success';
                    $message = 'Teacher responsible set successfully!';
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
                //dd($ex->getMessage());
                $messageLevel = 'danger';
                $message = "The selected teacher is already selected for another class!";
            }
        }

        $request->session()->flash('message.level', $messageLevel);
        $request->session()->flash('message.content', $message);

        return back()->withInput();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}

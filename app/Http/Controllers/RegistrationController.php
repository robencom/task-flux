<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classe;
use App\Registration;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $classes = Classe::all();

        return view('management.add_student',compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $messageLevel='';
        $message='';

        try {
            $registration = new Registration;
            $registration->student_id = $request->student_id;
            $registration->class_id = $request->class_id;
            $registration->save();
            $messageLevel = 'success';
            $message = 'Student registered successfully!';
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $messageLevel = 'danger';
            $message = 'Error. Try gain later!';

        }
        catch(\Illuminate\Database\QueryException $ex) {
            echo $ex->getMessage();
            $messageLevel = 'danger';
            $message = "The selected student is already registered to the selected class!";
        }

        $request->session()->flash('message.level', $messageLevel);
        $request->session()->flash('message.content', $message);

        return back()->withInput();

    }

}


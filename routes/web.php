<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home
Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/home', function () {
    return view('layouts.home');
});

//classes
Route::get('/class', 'ClasseController@index');

Route::post('/show', 'ClasseController@show');

//students
Route::get('/add_student', 'RegistrationController@index');

Route::post('/store_student', 'RegistrationController@store');

//teachers
Route::get('/add_teacher', 'TeacherController@index');

Route::post('/store_teacher', 'TeacherController@store');

//Courses
Route::get('/add_course', 'CourseController@index');

Route::post('/store_course', 'CourseController@store');

Route::get('/edit_course', 'CourseController@edit');

Route::post('/update_course', 'CourseController@update');

//Schedules
Route::get('/add_schedule', 'ScheduleController@index');

Route::post('/store_schedule', 'ScheduleController@store');

//Class Schedules
Route::get('/add_class_schedule', 'ClassScheduleController@index');

Route::post('/store_class_schedule', 'ClassScheduleController@store');



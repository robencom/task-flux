<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPkCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function($table) {
             // $table->dropPrimary();
             // $table->primary(['id', 'teacher_id']);
             \DB::unprepared('ALTER TABLE `task_class`.`courses` 
                              DROP PRIMARY KEY,
                              ADD PRIMARY KEY (`id`, `teacher_id`);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function($table) {
             $table->primary('id');
        });
    }
}

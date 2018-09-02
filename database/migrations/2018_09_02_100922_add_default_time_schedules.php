<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultTimeSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function($table) {
             \DB::unprepared('ALTER TABLE `schedules` 
                              CHANGE COLUMN `start_time` `start_time` TIME NOT NULL DEFAULT "00:00:00" ,
                              CHANGE COLUMN `end_time` `end_time` TIME NOT NULL DEFAULT "00:00:00" ;');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

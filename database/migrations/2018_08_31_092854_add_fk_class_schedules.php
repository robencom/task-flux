<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClassSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_schedules', function($table) {
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_schedules', function(Blueprint $table)
        {
            //$table->dropForeign('class_id');
            $table->dropForeign('classes_class_id_foreign');
            //$table->dropForeign('schedule_id');
            $table->dropForeign('classes_schedule_id_foreign');
        });
    }
}

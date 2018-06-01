<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_number');
            $table->date('log_date');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->boolean('log_status')->default(0);
            $table->timestamps();

            $table->foreign('student_number')->references('student_number')->on('student_infos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('library_logs');
    }
}

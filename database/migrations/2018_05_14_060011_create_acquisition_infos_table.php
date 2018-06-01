<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquisitionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisition_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('acquisition_type_id');
            $table->integer('quantity');
            $table->date('date_acquired');
            $table->boolean('cancelled')->default(false);
            $table->timestamps();

            $table->foreign('acquisition_type_id')->references('id')->on('acquisition_types');
            $table->foreign('book_id')->references('id')->on('book_infos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acquisition_infos');
    }
}

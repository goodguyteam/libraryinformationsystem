<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposal_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('disposal_type_id');
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('disposal_type_id')->references('id')->on('disposal_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposal_infos');
    }
}

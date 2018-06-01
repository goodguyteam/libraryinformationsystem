<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookShelvingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_shelvings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('call_number')->unique();
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('shelf_id');
            $table->unsignedInteger('section_id');
            $table->string('book_sequence');
            $table->timestamps();

            $table->foreign('shelf_id')->references('id')->on('library_shelves');
            $table->foreign('section_id')->references('id')->on('shelf_sections');
            $table->foreign('class_id')->references('id')->on('classifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_shelvings');
    }
}

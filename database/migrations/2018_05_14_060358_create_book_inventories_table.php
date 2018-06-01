<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isbn')->nullable()->unique();
            $table->string('accession_number')->nullable()->unique();
            $table->unsignedInteger('acquisition_info_id');
            $table->unsignedInteger('book_info_id');
            $table->unsignedInteger('shelving_id');
            $table->unsignedInteger('book_status_id');
            $table->unsignedInteger('disposal_info_id')->nullable();
            $table->unsignedInteger('missing_info_id')->nullable();
            $table->timestamps();

            $table->foreign('acquisition_info_id')->references('id')->on('acquisition_infos');
            $table->foreign('book_info_id')->references('id')->on('book_infos');
            $table->foreign('shelving_id')->references('id')->on('book_shelvings');
            $table->foreign('book_status_id')->references('id')->on('book_inventory_statuses');
            $table->foreign('disposal_info_id')->references('id')->on('disposal_infos');
            $table->foreign('missing_info_id')->references('id')->on('missing_infos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_inventories');
    }
}

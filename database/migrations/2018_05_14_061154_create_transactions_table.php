<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->dateTime('date_borrowed');
            $table->dateTime('date_returned');
            $table->unsignedInteger('student_borrower_id')->nullable();
            $table->unsignedInteger('personnel_borrower_id')->nullable();
            $table->unsignedInteger('book_copy_id');
            $table->timestamps();

            $table->foreign('student_borrower_id')->references('id')->on('student_infos');
            $table->foreign('personnel_borrower_id')->references('id')->on('personnel_infos');
            $table->foreign('book_copy_id')->references('id')->on('book_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

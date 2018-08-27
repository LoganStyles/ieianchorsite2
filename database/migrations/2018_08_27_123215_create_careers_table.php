<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('oname')->nullable();
            $table->dateTime('dob');
            $table->dateTime('available_startdate');
            $table->string('salary');
            $table->string('email');
            $table->string('phone');
            $table->string('states');
            $table->enum('process_status', ['yes', 'no'])->default('no');
            $table->enum('validated', ['yes', 'no'])->default('no');
            $table->string('type')->default('career');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('careers');
    }
}

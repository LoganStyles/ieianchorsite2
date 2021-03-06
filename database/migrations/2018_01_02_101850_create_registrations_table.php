<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->dateTime('dob');
            $table->string('employer');
            $table->string('employer_address');
            $table->string('oname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('states');
            $table->enum('process_status', ['yes', 'no'])->default('no');
            $table->enum('validated', ['yes', 'no'])->default('no');
            $table->string('type')->default('registration');
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
        Schema::dropIfExists('registrations');
    }
}

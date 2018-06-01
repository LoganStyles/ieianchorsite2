<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqcats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position')->default(0);
            $table->string('keywords')->nullable();
            $table->string('link_label')->nullable();
            $table->text('details')->nullable();
            $table->string('excerpt')->nullable();
            $table->enum('display',['0','1']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->default('faqcat');
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
        Schema::dropIfExists('faqcats');
    }
}

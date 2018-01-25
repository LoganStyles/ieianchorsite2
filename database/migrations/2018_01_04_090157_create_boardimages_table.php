<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardimages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemid');
            $table->string('filename');
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->enum('main',['0','1'])->nullable();
            $table->string('type')->default('board');
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
        Schema::dropIfExists('boardimages');
    }
}

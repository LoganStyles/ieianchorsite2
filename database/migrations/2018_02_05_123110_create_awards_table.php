<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('details')->nullable();
            $table->string('link_label')->nullable();
            $table->integer('position')->default(0);
            $table->enum('display',['0','1']);
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->default('award');
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
        Schema::dropIfExists('awards');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type')->default('role');
            $table->text('description')->nullable();
            $table->enum('user',['1','2','3','4'])->default(1);
            $table->enum('role',['1','2','3','4'])->default(1);            
            $table->enum('management',['1','2','3','4'])->default(1);
            $table->enum('board',['1','2','3','4'])->default(1);
            $table->enum('newsitem',['1','2','3','4'])->default(1);
            $table->enum('testimonial',['1','2','3','4'])->default(1);
            $table->enum('service',['1','2','3','4'])->default(1);
            $table->enum('about',['1','2','3','4'])->default(1);
            $table->enum('report',['1','2','3','4'])->default(1);
            $table->enum('delete_group',['0','1'])->default(0);
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
        Schema::dropIfExists('roles');
    }
}

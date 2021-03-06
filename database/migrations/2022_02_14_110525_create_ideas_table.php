<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('status_id');
            $table->string('title');
            $table->string('title_second')->nullable();
            $table->string('image');
            $table->string('image_second')->nullable();
            $table->string('status')->nullable();
            $table->string('hide_name')->nullable();
            $table->integer('idea_type')->nullable();
            $table->string('slug')->nullable();
            $table->text('description'); 
            $table->string('date')->nullable();   
            $table->integer('votes')->default(0);
            $table->integer('spams')->default(0);

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
        Schema::dropIfExists('ideas');
    }
}

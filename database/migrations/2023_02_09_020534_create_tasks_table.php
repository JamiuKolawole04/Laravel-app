<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // user id for created tasks
            $table->unsignedBigInteger("user_id");
            $table->string("name");
            $table->string("description");
            $table->string("priority")->default("medium");

            // definging foreign constarints that must be equal to the user_id column above on users table referencing the id and deleteing in a 
            // cascading fashion
            $table->foreign("user_id")
              ->references("id")
              ->on("users")
              ->onDelete("cascade");
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
        Schema::dropIfExists('tasks');
    }
};
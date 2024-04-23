<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->enum('model_type', ['advertise', 'product'])->nullable();
            $table->timestamps();
            
            $table->foreign('from_user_id', 'rooms_from_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_user_id', 'rooms_to_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}

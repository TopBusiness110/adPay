<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->text('message');
            $table->boolean('seen')->default(0);
            $table->timestamps();
            
            $table->foreign('from_user_id', 'chats_from_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id', 'chats_room_id_foreign')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_user_id', 'chats_to_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}

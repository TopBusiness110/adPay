<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->longText('body');
            $table->text('logo')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('type', ['user', 'vendor', 'advertise', 'all']);
            $table->timestamps();
            
            $table->foreign('user_id', 'notifications_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    use HasFactory;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->text('image')->nullable();
            $table->bigInteger('phone');
            $table->text('password');
            $table->boolean('verified_at')->default(0);
            $table->enum('type', ['user', 'vendor', 'advertise']);
            $table->longText('device_token');
            $table->boolean('status')->default(1);
            $table->longText('session')->nullable();
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
        Schema::dropIfExists('app_users');
    }
}

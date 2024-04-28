<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_video')->nullable();
            $table->text('auction_vat_description')->nullable();
            $table->text('logo')->nullable();
            $table->text('about_us')->nullable();
            $table->text('privacy')->nullable();
            $table->text('phones')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('fcm_server')->nullable();
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
        Schema::dropIfExists('settings');
    }
}

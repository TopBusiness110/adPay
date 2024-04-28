<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('description_ar');
            $table->string('description_en');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status')->default(0);
            $table->boolean('payment_status')->default(0);
            $table->unsignedBigInteger('count_views');
            $table->bigInteger('package_id');
            $table->unsignedBigInteger('views');
            $table->boolean('complete')->default(0);
            $table->text('video')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id', 'ads_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}

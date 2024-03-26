<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('title_ar',255);
            $table->string('title_en',255);
            $table->string('description_ar',255);
            $table->string('description_en',255);
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('count_views');
            $table->unsignedBigInteger('views');
            $table->tinyInteger('complete')->default(0);
            $table->text('video')->nullable();

            $table->foreign('user_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};

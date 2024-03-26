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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->text('images');
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->unsignedBigInteger('user_id');
            $table->text('video')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_cat_id');



            $table->foreign('user_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('cat_id')->references('id')->on('auction_categories')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('sub_cat_id')->references('id')->on('auction_sub_categories')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};

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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('banner')->nullable();
            $table->string('title_ar',500);
            $table->string('title_en',500);
            $table->unsignedBigInteger('shop_cat_id');
            $table->longText('shop_sub_cat');
            $table->unsignedBigInteger('vendor_id');

            $table->foreign('vendor_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('shop_cat_id')->references('id')->on('shop_categories')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('banner')->nullable();
            $table->string('title_ar', 500);
            $table->string('title_en', 500);
            $table->unsignedBigInteger('shop_cat_id');
            $table->longText('shop_sub_cat');
            $table->unsignedBigInteger('vendor_id');
            $table->timestamps();
            
            $table->foreign('shop_cat_id', 'shops_shop_cat_id_foreign')->references('id')->on('shop_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id', 'shops_vendor_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}

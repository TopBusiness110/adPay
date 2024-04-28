<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->longText('images');
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->double('price');
            $table->double('discount');
            $table->enum('type', ['new', 'used']);
            $table->unsignedBigInteger('shop_cat_id');
            $table->text('shop_sub_cat');
            $table->unsignedBigInteger('stock');
            $table->longText('props');
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('shop_cat_id', 'products_shop_cat_id_foreign')->references('id')->on('shop_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id', 'products_vendor_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

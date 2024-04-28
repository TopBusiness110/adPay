<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('qty');
            $table->double('amount', 10, 2);
            $table->double('vat', 10, 2);
            $table->double('discount', 10, 2);
            $table->double('total', 10, 2);
            $table->double('shipping_price', 10, 2);
            $table->enum('shipping_type', ['vendor', 'company'])->default('vendor');
            $table->text('region');
            $table->text('area');
            $table->text('address_details');
            $table->timestamps();
            
            $table->foreign('order_id', 'order_details_order_id_foreign')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'order_details_product_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}

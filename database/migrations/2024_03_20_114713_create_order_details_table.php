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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('qty');
            $table->double('amount',10,2);
            $table->double('vat',10,2);
            $table->double('discount',10,2);
            $table->double('total',10,2);
            $table->double('shipping_price',10,2);
            $table->enum('shipping_type',['vendor','company'])->default('vendor');
            $table->text('region');
            $table->text('area');
            $table->text('address_details');

            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('order_id')->references('id')->on('orders')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

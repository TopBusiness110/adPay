<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['new', 'pending', 'complete', 'cancelled']);
            $table->text('reference');
            $table->date('date');
            $table->double('total', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vendor_id');
            $table->timestamps();
            
            $table->foreign('user_id', 'orders_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id', 'orders_vendor_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

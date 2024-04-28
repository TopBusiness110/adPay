<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('rate', ['1', '2', '3', '4', '5']);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id', 'vendor_rates_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id', 'vendor_rates_vendor_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_rates');
    }
}

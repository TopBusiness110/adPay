<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('auction_id')->nullable();

            $table->foreign('auction_id', 'wishlists_auction_id_foreign')->references('id')->on('auctions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'wishlists_product_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'wishlists_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}

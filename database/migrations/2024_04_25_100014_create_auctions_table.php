<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->text('images');
            $table->double('price', 10, 2);
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('description_ar');
            $table->text('description_en')->nullable();
            $table->boolean('is_sold')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->text('video')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_cat_id');
            $table->timestamps();

            $table->foreign('cat_id', 'auctions_cat_id_foreign')->references('id')->on('auction_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_cat_id', 'auctions_sub_cat_id_foreign')->references('id')->on('auction_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'auctions_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}

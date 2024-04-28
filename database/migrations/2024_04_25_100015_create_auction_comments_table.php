<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->text('comment');
            $table->enum('type', ['comment', 'reply'])->default('comment');
            $table->timestamps();
            
            $table->foreign('auction_id', 'auction_comments_auction_id_foreign')->references('id')->on('auctions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'auction_comments_user_id_foreign')->references('id')->on('app_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_comments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionCommentsAuctionCommentsIbfk1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auction_comments', function (Blueprint $table) {
            $table->foreign('comment_id', 'auction_comments_ibfk_1')->references('id')->on('auction_comments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auction_comments', function(Blueprint $table){
            $table->dropForeign('auction_comments_ibfk_1');
        });
    }
}

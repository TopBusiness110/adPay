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
        Schema::create('auction_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->text('comment');
            $table->enum('type',['comment','reply'])->default('comment');

            $table->foreign('auction_id')->references('id')->on('auctions')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('to_user_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_comments');
    }
};

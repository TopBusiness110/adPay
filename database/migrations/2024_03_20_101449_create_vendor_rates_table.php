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
        Schema::create('vendor_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('rate',[1,2,3,4,5]);
            $table->text('description')->nullable();

            $table->foreign('vendor_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('app_users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_rates');
    }
};

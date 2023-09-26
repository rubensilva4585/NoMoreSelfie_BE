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
        Schema::create('user_sub_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('profile_id');
            $table->decimal('startPrice', 5, 2);
            $table->decimal('endPrice', 5, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->primary('user_id');
            $table->foreign('profile_id')->references('id')->on('profiles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sub_categories');
    }
};

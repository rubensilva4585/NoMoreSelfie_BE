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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_subCategory')->nullable();
            $table->dateTime('date');
            $table->string('address', 32)->nullable()->default(null);
            $table->longText('description')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreign('id_category')->references('id')->on('categories');
            $table->foreign('id_subCategory')->references('id')->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};

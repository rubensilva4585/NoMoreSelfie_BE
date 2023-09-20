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
        Schema::create('supplier__category__sub_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_subCategory');
            $table->decimal('startPrice', 5, 2);
            $table->decimal('endPrice', 5, 2);
            $table->timestamps();

            $table->primary(['id_supplier', 'id_category', 'id_subCategory']);

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
        Schema::dropIfExists('supplier__category__sub_categories');
    }
};

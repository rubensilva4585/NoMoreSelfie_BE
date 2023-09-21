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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_district');
            $table->string('phone', 16)->nullable()->default(null);
            $table->string('company', 50)->nullable()->default(null);
            $table->string('nif', 9);
            $table->string('address', 100)->nullable()->default(null);
            $table->longText('bio')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_district')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

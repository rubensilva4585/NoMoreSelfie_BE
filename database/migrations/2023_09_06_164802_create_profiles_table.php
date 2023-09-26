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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ['user', 'supplier', 'admin'])->default('user');
            $table->unsignedBigInteger('district_id');
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 16)->nullable()->default(null);
            $table->string('company', 50)->nullable()->default(null);
            $table->string('nif', 9);
            $table->string('address', 100)->nullable()->default(null);
            $table->longText('bio')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

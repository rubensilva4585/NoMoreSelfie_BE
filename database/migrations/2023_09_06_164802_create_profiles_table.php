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
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('company', 50)->nullable()->default(null);
            $table->string('nif', 9)->nullable();
            $table->text('bio')->nullable()->default(null);
            $table->longText('service_description')->nullable()->default(null);
            $table->boolean('verified')->default(false);
            $table->string('avatar')->nullable()->default(null);
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

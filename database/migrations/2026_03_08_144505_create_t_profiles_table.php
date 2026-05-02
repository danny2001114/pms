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
        Schema::create('t_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->tinyInteger("gender")->comment("1: male, 2: female");
            $table->date("birthday");
            $table->text("address");
            $table->string("git_acc");
            $table->string("image")->nullable();
            $table->text("bio")->nullable();

            $table->foreign('user_id')->on('t_users')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_profiles');
    }
};

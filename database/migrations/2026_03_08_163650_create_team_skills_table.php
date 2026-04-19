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
        Schema::create('team_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('skill_id');
            $table->boolean('main')->default(false);
            $table->timestamps();
            $table->foreign('team_id')->on('teams')->references('id')->cascadeOnDelete();
            $table->foreign('skill_id')->on('skills')->references('id')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_skills');
    }
};

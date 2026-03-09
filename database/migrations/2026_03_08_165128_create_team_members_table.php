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
        Schema::create('team_members', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->unique('member');
            $table->unsignedBigInteger('team_id');
            $table->timestamps();
            $table->foreign('member_id')->on('members')->references('id')->cascadeOnDelete();
            $table->foreign('team_id')->on('teams')->references('id')->cascadeOnDelete();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};

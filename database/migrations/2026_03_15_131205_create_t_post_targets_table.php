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
        Schema::create('t_post_targets', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('target')->default(0)->comment('0: All, 1: User, 2: Team, 3: Project');
            $table->bigInteger('target_id')->nullable();
            $table->boolean('by_role')->default(false);
            $table->unsignedBigInteger('post_id');

            $table->foreign('post_id')->on('t_posts')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_post_targets');
    }
};

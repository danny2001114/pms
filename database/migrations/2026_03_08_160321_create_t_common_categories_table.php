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
        Schema::create('t_common_categories', function (Blueprint $table) {
            $table->id();
            $table->morphs('ref'); // Project, Task
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->on('t_categories')->references('id')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_common_categories');
    }
};

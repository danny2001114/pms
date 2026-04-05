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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->unsignedBigInteger('project_id');
            $table->text('description');
            $table->tinyInteger('priority')->default(2)->comment('1: low, 2: mediumn, 3: high');
            $table->tinyInteger('state')->default(1)->comment('1: pending, 2: developing, 3: testing, 4: fixing, 5: completed');
            $table->integer('percentage')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('skill_ids')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->on('projects')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

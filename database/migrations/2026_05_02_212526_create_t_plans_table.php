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
        Schema::create('t_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('order')->nullable();
            $table->text('remark');
            $table->unsignedBigInteger('task_id');
            $table->boolean('highlight')->default(false);
            $table->boolean('status')->default(false);
            $table->date('date')->useCurrent();

            $table->foreign('task_id')->on('t_tasks')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_plans');
    }
};

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
        Schema::create('assignees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->integer('member_id');
            $table->boolean('cur_active')->default(true);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignees');
    }
};

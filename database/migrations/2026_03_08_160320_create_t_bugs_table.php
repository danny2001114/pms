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
        Schema::create('t_bugs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->unsignedBigInteger('task_id');
            $table->text('content');
            $table->tinyInteger('state')->default(1)->comment('1: pending, 2: fixing, 3: completed, 4: close');
            $table->bigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_bugs');
    }
};

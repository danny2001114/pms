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
        Schema::create('t_activity_logs', function (Blueprint $table) {
            $table->string('table');
            $table->string('user_name');
            $table->string('user_code');
            $table->text('message');
            $table->datetime('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_activity_logs');
    }
};

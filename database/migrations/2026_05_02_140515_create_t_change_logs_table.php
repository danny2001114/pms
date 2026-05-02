<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * note ensure to delete after deleting the parent.
     */
    public function up(): void
    {
        Schema::create('t_change_logs', function (Blueprint $table) {
            $table->tinyIncrements('ref')->comment('1: User, 2: Task, 3: Bug, 4: Post');
            $table->tinyInteger('role')->nullable()->comment("1: member, 2: leader, 3: admin, 4: super");
            $table->string('key', 10)->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_change_logs');
    }
};

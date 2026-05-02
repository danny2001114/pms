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
        Schema::create('t_configurations', function (Blueprint $table) {
            $table->string('key', 100);
            $table->tinyInteger('type')->default(1)->comment('1: text, 2: num, 3: bool');
            $table->string('value');
            $table->bigInteger('updated_by')->nullable();
            $table->datetime('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_configurations');
    }
};

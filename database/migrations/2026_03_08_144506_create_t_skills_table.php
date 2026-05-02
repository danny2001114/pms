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
        Schema::create('t_skills', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100)->unique();
            $table->tinyInteger("type")->comment('1: programming, 2: technical, 3: business, 4: language');
            $table->string("logo")->nullable();
            $table->text("remark")->nullable();
            $table->boolean("active")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_skills');
    }
};

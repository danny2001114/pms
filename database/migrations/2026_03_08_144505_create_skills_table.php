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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("image", 100)->nullable();
            $table->unsignedBigInteger("main_id")->nullable();
            $table->boolean("active")->default(true);
            $table->timestamps();
            $table->foreign("main_id")->on("skills")
                ->references("id")
                ->cascadeOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('title', 255);
            $table->text('description');
            $table->unsignedBigInteger('owner_id');
            $table->tinyInteger('state')->default(1)->comment('1: develop, 2: maintain, 3: feature');
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger("type_id");
            $table->tinyInteger("priority")->default(1)->comment('1: low, 2: medium, 3: high');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('created_by');
            $table->timestamps();
            $table->foreign('owner_id')->on('users')->references('id')->restrictOnDelete();
            $table->foreign('type_id')->on('project_types')->references('id')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

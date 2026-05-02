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
        Schema::create('t_projects', function (Blueprint $table) {
            $table->id();
            $table->string('key', 10)->unique();
            $table->string('title');
            $table->unsignedBigInteger('owner_id');
            $table->tinyInteger('state')->default(1)->comment('1: develop, 2: maintain, 3: feature');
            $table->boolean('active')->default(true);
            $table->tinyInteger("priority")->default(1)->comment('1: low, 2: medium, 3: high');
            $table->date('start_date')->useCurrent();
            $table->date('end_date');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')->on('t_users')->references('id')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_projects');
    }
};

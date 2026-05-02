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
        Schema::create('t_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('issue_no', 10);
            $table->bigInteger('assignor_id');
            $table->bigInteger('assignee_id');
            $table->unsignedBigInteger('project_id');
            $table->tinyInteger('state')->default(1)->comment('1: pending, 2: on hold, 3: testing, 4: fixing, 5: completed');
            $table->tinyInteger('priority')->default(2)->comment('1: low, 2: mediumn, 3: high');
            $table->integer('percentage')->default(0);
            $table->datetime('start_datetime')->useCurrent();
            $table->datetime('end_datetime');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')->on('t_projects')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tasks');
    }
};

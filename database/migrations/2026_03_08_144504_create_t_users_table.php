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
        Schema::create('t_users', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->nullable();
            $table->string('password', 60);
            $table->string('name', 100);
            $table->string("email", 100)->nullable();
            $table->string("phone", 11)->nullable();
            $table->tinyInteger('role')->default(1)->comment("1: member, 2: leader, 3: admin, 4: super");
            $table->boolean('is_request')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletesDatetime();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_users');
        Schema::dropIfExists('sessions');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('password', 60);
            $table->string('name', 100);
            $table->string("email", 100)->nullable();
            $table->string("phone", 11)->nullable();
            $table->tinyInteger('role')->default(1)->comment("1: member, 2: leader, 3: admin, 4: super");
            $table->tinyInteger("gender")->nullable()->comment("1: male, 2: female");
            $table->date("birthday")->nullable();
            $table->text("address")->nullable();
            $table->text("bio")->nullable();
            $table->string("image", 100)->nullable();
            $table->rememberToken();
            $table->softDeletesDatetime();
            $table->timestamps();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};

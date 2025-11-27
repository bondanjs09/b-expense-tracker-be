<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('be_user_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->unique();
            $table->text('password');
            $table->enum('role', ['USER', 'ADMIN', 'SUPERADMIN'])->default('USER');
            $table->tinyInteger('isActive')->default(1);
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('be_user_tbl');
    }
};

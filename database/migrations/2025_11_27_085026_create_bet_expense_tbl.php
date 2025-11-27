<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bet_expense_tbl', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT PRIMARY KEY
            $table->string('name', 100); // VARCHAR(100) NOT NULL
            $table->unsignedBigInteger('price'); // BIGINT NOT NULL
            $table->unsignedBigInteger('categoryId'); // BIGINT NOT NULL
            $table->tinyInteger('isActive')->default(1); // TINYINT DEFAULT 1
            $table->unsignedBigInteger('createdBy'); // BIGINT NOT NULL
            $table->unsignedBigInteger('updatedBy')->nullable(); // BIGINT (nullable)

            // Custom timestamps
            $table->timestamp('createdAt'); // NOT NULL
            $table->timestamp('updatedAt')->nullable();

            // Optional Foreign Key (jika ingin diaktifkan)
            // $table->foreign('categoryId')->references('id')->on('bet_category_tbl');
            // $table->foreign('createdBy')->references('id')->on('me_user_tbl');
            // $table->foreign('updatedBy')->references('id')->on('me_user_tbl');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bet_expense_tbl');
    }
};

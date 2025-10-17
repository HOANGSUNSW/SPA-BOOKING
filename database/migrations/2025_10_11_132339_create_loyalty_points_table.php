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
        Schema::create('loyalty_points', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('points')->default(0);
            $table->enum('level', ['bronze', 'silver', 'gold', 'platinum'])->default('bronze');
            $table->timestamps(); // tự động tạo cả created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_points');
    }
};

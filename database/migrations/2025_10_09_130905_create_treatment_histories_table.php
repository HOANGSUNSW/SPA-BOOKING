<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('treatment_histories', function (Blueprint $table) {
        $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
        $table->foreignId('treatment_id')->constrained('treatments')->onDelete('cascade');
        $table->datetime('session_date');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_histories');
    }
};

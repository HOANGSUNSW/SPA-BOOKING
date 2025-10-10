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
    Schema::create('bookings', function (Blueprint $table) {
        $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
        $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');
        $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->onDelete('set null');
        $table->datetime('appointment_time');
        $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
        $table->text('note')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

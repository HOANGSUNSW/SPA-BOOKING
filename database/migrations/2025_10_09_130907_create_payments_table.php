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
    Schema::create('payments', function (Blueprint $table) {
        $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
        $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
        $table->decimal('amount', 10, 2);
        $table->string('method'); // Momo, ZaloPay, VNPAY...
        $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

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
    Schema::create('work_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->date('work_date'); // ngày làm việc
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->string('shift_name')->nullable(); // Ca sáng, Chiều, Tối,...
        $table->string('note')->nullable();
        $table->timestamps();

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_schedules');
    }
};

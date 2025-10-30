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
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('employee_code', 20)->unique();
    $table->string('full_name', 20)->nullable();
    $table->string('email')->nullable()->unique();
    $table->string('phone_number', 20)->nullable()->unique();
    $table->string('id_card', 20)->nullable();
    $table->string('address')->nullable();
    $table->enum('role', ['admin', 'staff', 'user'])->default('staff'); // 👈 Chức vụ
    $table->enum('status', ['Active', 'Inactive'])->default('Active');
    $table->text('note')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

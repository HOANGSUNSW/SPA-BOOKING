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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 20)->unique();      // Mã KH tự sinh (VD: KH001)
            $table->string('full_name');                        // Họ tên khách hàng
            $table->string('email')->nullable()->unique();      // Email (để đăng nhập hoặc nhận thông báo)
            $table->string('phone_number', 20)->unique();       // SĐT (đặt lịch / tư vấn)
            $table->string('address')->nullable();              // Địa chỉ khách hàng
            $table->enum('gender', ['Nam', 'Nữ', 'Khác'])->nullable(); // Giới tính
            $table->date('dob')->nullable();                    // Ngày sinh
            $table->integer('loyalty_points')->default(0);      // Điểm tích lũy (chăm sóc KH)
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Trạng thái
            $table->text('note')->nullable();                   // Ghi chú (VD: da nhạy cảm, khách VIP)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

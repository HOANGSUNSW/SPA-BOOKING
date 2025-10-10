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
    Schema::create('treatments', function (Blueprint $table) {
        $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
        $table->string('name'); // treatment name
        $table->text('description')->nullable(); // treatment details
        $table->enum('status', ['ongoing', 'completed', 'expired'])->default('ongoing');
        $table->date('expiry_date')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};

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
        Schema::create('banned_users', function (Blueprint $table) {
            // ID của user bị ban, đồng thời là khoá chính để đảm bảo mỗi user chỉ bị ban 1 lần
            $table->id('user_id');
            // ID của admin đã ban user đó
            $table->bigInteger('admin_id')->unsigned();
            // Lý do bị ban
            $table->string('reason');
            // Ban vĩnh viễn thì đặt expired_at = null
            $table->timestamp('expired_at')->nullable();
            // Thời gian tạo và thời gian cập nhật
            $table->timestamps();

            // Liên kết khoá ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banned_users');
    }
};

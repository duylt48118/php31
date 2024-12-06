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
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sinh_vien');
            $table->string('ma_sinh_vien', 20)->unique(); //K cho phép giá trị trùng nhau 
            $table->date('ngay_sinh');
            $table->string('hinh_anh')->nullable();
            $table->string('so_dien_thoai',15);
            $table->boolean('trang_thai')->default(true); // Xét giá trị mặc định cho trường
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhviens');
    }
};

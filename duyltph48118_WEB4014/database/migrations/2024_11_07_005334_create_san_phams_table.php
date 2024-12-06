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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->string('ma_san_pham', 20)->unique(); //K cho phép giá trị trùng nhau 
            $table->decimal('gia', 10, 2);
            $table->decimal('gia_khuyen_mai', 10, 2)->nullable(); // Cho phép trường có giá trị null
            $table->unsignedInteger('so_luong');
            $table->date('ngay_nhap');
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true); // Xét giá trị mặc định cho trường
            $table->timestamps(); // Timestamps tự sinh ra trường create_at và update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};

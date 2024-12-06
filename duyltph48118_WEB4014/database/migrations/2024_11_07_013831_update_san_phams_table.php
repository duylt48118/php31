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
        Schema::table('san_phams', function (Blueprint $table) {
            // $table->foreignIdFor(DanhMuc::class)->after('ten_san_pham'); // tao khoa ngoai toi bang danh muc
            $table->string('hinh_anh')->nullable()->after('trang_thai');
            $table->date('ngay_nhap')->default(date('Y-m-d'))->change(); // cap nhat truong bang migration
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn('hinh_anh'); //xoa hinh anh
            $table->date('ngay_nhap')->change(); // cap nhat ngc lai ngay nhap
        });
    }
};
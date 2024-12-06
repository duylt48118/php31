<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <=5 ; $i++) { 
            DB::table('sinhviens')->insert([
                'ten_sinh_vien' => "Sinh vien $i",
                'ma_sinh_vien' => "Msv $i",
                'ngay_sinh' => date('Y-m-d', strtotime("2003-08-03")),
                'so_dien_thoai' => "097141451",
                'hinh_anh'=> null,
                'trang_thai' => true,
            ]);
        }
    }
}

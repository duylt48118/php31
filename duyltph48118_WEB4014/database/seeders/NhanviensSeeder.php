<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NhanviensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=1; $i < 5 ; $i++) { 
            # code...
            DB::table('nhan_viens')->insert([
                'ma_nhan_vien'=> " ph$i ",
                'ten_nhan_vien'=> "Nguyễn Văn $i",
                'hinh_anh'=> null,
                'ngay_vao_lam'=> "2024-$i-$i",
                'luong'=> "$i",
                'trang_thai'=> true

            ]);
        }
    }
}

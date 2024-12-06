<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=0; $i <= 5; $i++) { 
            DB::table('nhan_viens')->insert([
                
                'name'=> "Nguyễn Văn $i",
                'gender'=> "Nam",
                'phone'=> "304865370$i",
                'address'=> "abc",
                'hinh_anh'=> null,
                'trang_thai'=> true

            ]);
        }
    }
}

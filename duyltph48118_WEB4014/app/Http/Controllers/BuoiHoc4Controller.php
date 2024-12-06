<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuoiHoc4Controller extends Controller
{
    public function xinChao($name, $class){
         echo "XIn chào các bạn";
        
         echo "Họ tên là: $name - Lớp: $class";
         $title = 'Chào mừng quý khách';
         $des   = 'Chúc quý khách vạn sự bình an!';

        //  hiển thị view trong controller
         return view('buoi4', compact('title', 'des'));
    }
    
    public function tinhTong($a, $b){
     $tong = $a+$b;
     $title = 'Chào mừng quý khách';
     $des   = 'Chúc quý khách vạn sự bình an!';
     return view('buoi4',compact('title', 'des','tong'));
    }
    // Tạo 1 route trỏ đến 1 hàm tính tổng
    // Truyền 2 số lên url 
    // Trong hàm tính tổng thực hiện tính giá trị 
    // và hiển thị ra file view buoi4.php
}

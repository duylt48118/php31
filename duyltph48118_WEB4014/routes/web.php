<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\BuoiHoc4Controller;
use App\Http\Controllers\BuoiHoc5Controller;
use App\Http\Controllers\NhanviensController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use App\Http\Controllers\Admin\SinhVienController;
use App\Http\Controllers\Admins\AdminSanPhamController;
use App\Http\Controllers\Client\ClientSanPhamController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// - Routing trong laravel là chức năng khai báo các đường dẫn
//   để đưa người dùng đến các chức năng có trong hệ thống
// - Mỗi 1 route chỉ sử dụng để trỏ đến 1 chức năng cụ thể

// - Loại 1: Route nạp trức tiếp view
Route::view('/buoi4_1', 'buoi4',[
    'title' => 'Chào mừng quý khách',
    'des'  => 'Chúc quý khách vạn sự bình an!'
]);

Route::get('/home', function(){
    return 'hello';
});
//  -Loại 2: Sử dụng view thông qua controller (Thường dùng)
Route::get('/buoi4_2/{name}/{class}', [BuoiHoc4Controller::class,'xinChao']);
Route::get('buoi4_3/{a}/{b}',[BuoiHoc4Controller::class,'tinhTong']);

Route::get('/buoi5_1',[BuoiHoc5Controller::class,'hienThi']);

Route::get('/list',[SanPhamController::class,'inDex']);
Route::get('/create',[SanPhamController::class,'creatSanPham']);
Route::get('/edit',[SanPhamController::class,'editSanpham']);



Route::resource('sanphams',AdminSanPhamController::class)->middleware(['auth','auth.admin']);

// Route::resource('sanphamss',ClientSanPhamController::class);

Route::resource('sinhviens',SinhVienController::class);

Route::get('/admin',function(){
    return 'đây là trang admin';
});

Route::resource('nhanviens',NhanviensController::class);





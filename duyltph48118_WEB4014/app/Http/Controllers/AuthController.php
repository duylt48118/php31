<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Đăng nhập
    public function showFormtLogin(){
        return view('auth.login');
    }
    // Đăng ký
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
    
        // Thử đăng nhập với thông tin đã nhập
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng đến trang home
            return redirect()->intended('sanphams');
        }
    
        // Nếu đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Thông tin người dùng không đúng.',
        ]);
    }
    public function showFormtRegister(){
        return view('auth.register');

    }
  
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        // Mã hóa mật khẩu
        $data['password'] = bcrypt($data['password']);
    
        $user = User::query()->create($data);
    
        Auth::login($user);
    
        return redirect()->intended('sanphams');
    }
    
    
    // Đăng xuất
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}

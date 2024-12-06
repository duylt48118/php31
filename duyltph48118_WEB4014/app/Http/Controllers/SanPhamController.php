<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    //
    public function inDex(){
          return view('admins.SanPham.index');
    }

    public function creatSanPham(){
          return view('admins.SanPham.create');
       }
    
    public function editSanpham(){
        return view('admins.SanPham.edit');
    }
}

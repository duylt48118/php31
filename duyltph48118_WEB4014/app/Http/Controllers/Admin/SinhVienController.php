<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSinhVienRequest;
use Illuminate\Support\Facades\Storage;

class SinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $query = DB::table('sinhviens')->orderByDesc('id');
       $key = $request->input('key');
       if($key){
        $query->where(function($query)use ($key){
              $query->where('ma_sinh_vien','like',"%$key%")
              ->orWhere('ten_sinh_vien','like',"%$key%");
        });

       }
       $listSinhVien = $query->paginate(2);
       return view('admins.sinhviens.index', compact('listSinhVien'));  
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.sinhviens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSinhVienRequest $request)
    {
        DB::beginTransaction();
        try {
            //xử lý hình ảnh
            $filePath = null;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('uploads/sinhviens','public');
            }
            //xử lý thêm dữ liệu
            $dataSanPham = [
                'ma_sinh_vien' => $request->input('ma_sinh_vien'),
                'ten_sinh_vien' => $request->input('ten_sinh_vien'),
                'ngay_sinh' => $request->input('ngay_sinh'),
                'so_dien_thoai' => $request->input('so_dien_thoai'),
                'hinh_anh' => $filePath,
                'trang_thai' => $request->input('trang_thai'),
                'created_at' => now(),
                'updated_at' => null,
            ];
            // kiểm tra xem đã lấy được dữ liệu lên chưa
            // dd($dataSanPham);
            // lưu dữ liệu database
            DB::table('sinhviens')->insert($dataSanPham);

            DB::commit();

            return redirect()->route('sinhviens.index')
            ->with('success','Thêm sản phẩm thành công');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('sinhviens.index')
            ->with('error','Có lỗi khi thêm sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     */
  public function show(string $id)
{
    // Tìm sinh viên theo ID
    $sinhVien = DB::table('sinhviens')->find($id);

    // Kiểm tra nếu sinh viên không tồn tại
    if (!$sinhVien) {
        return redirect()->route('sinhviens.index')
            ->with('error', 'Sinh viên không tồn tại');
    }

    // Trả về view với dữ liệu sinh viên
    return view('admins.sinhviens.show', compact('sinhVien'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanPham = DB::table('sinhviens')->find($id);
        if(!$sanPham){
            return redirect()->route('sinhviens.index')
            ->with('error','Sinh viên khong ton tai');

        }
        return view('admins.sinhviens.edit',compact('sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSinhVienRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $sinhVien = DB::table('sinhviens')->find($id);
            if(!$sinhVien){
                return redirect()->route('sinhviens.index')
                ->with('error','Sinh viên khong ton tai');
    
            }
            //xử lý hình ảnh
            $filePath = $sinhVien->hinh_anh;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('uploads/sinhViens','public');
                //xoa hinh cu neu co hinh anh moi day len
                if($sinhVien->hinh_anh && Storage::disk('public')->exists($sinhVien->hinh_anh)){
                    Storage::disk('public')->delete($sinhVien->hinh_anh);
                }
            }
            //xử lý cap nhat giu lieu
            $dataSinhVien = [
                // 'ma_sinh_vien' => $request->input('ma_sinh_vien'),
                'ten_sinh_vien' => $request->input('ten_sinh_vien'),
                'ngay_sinh' => $request->input('ngay_sinh'),
                'so_dien_thoai' => $request->input('so_dien_thoai'),
                'hinh_anh' => $filePath,
                'trang_thai' => $request->input('trang_thai'),
                'updated_at' => now(),
            ];
            // kiểm tra xem đã lấy được dữ liệu lên chưa
            // dd($dataSinhVien);
            // lưu dữ liệu database
            DB::table('sinhviens')->where('id', $id)->update($dataSinhVien);

            DB::commit();

            return redirect()->route('sinhviens.index')
            ->with('success','Cap nhat sinh viên thành công');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('sinhviens.index')
            ->with('error','Có lỗi khi cap nhat');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sinhVien = DB::table('sinhviens')->find($id);
        if(!$sinhVien){
            return redirect()->route('sanphams.index')
            ->with('error','San pham khong ton tai');

        }

        //luu giu tam thoi duong dan cua hinh anh vao day
        $filePath = $sinhVien->hinh_anh;
        
        $deleteSanPham = DB::table('sinhviens')->where('id',$id)->delete();

        if($deleteSanPham){
            if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                  Storage::disk('public')->delete($filePath);
            }
            return redirect()->route('sinhviens.index')
            ->with('success','xoa sinh viên thành công');
          
        }
        return redirect()->route('sinhviens.index')
        ->with('error','Co loi khi xoa');
    }
}

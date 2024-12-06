<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminSanPhamRequest;

class AdminSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('san_phams')->orderByDesc('id');
        $key = $request->input('key');
        if ($key) {
            $query->where(function ($query) use ($key) {
                $query->where('ma_san_pham', 'like', "%$key%")
                    ->orWhere('ten_san_pham', 'like', "%$key%");
            });
        }
        $listSanPham = $query->paginate(2);
        return view('admins.sanphams.index', compact('listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.sanphams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminSanPhamRequest $request)
    {
        DB::beginTransaction();
        try {
            //xử lý hình ảnh
            $filePath = null;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('uploads/sanphams','public');
            }
            //xử lý thêm dữ liệu
            $dataSanPham = [
                'ma_san_pham' => $request->input('ma_san_pham'),
                'ten_san_pham' => $request->input('ten_san_pham'),
                'gia' => $request->input('gia'),
                'gia' => $request->input('gia'),
                'gia_khuyen_mai' => $request->input('gia_khuyen_mai'),
                'so_luong' => $request->input('so_luong'),
                'ngay_nhap' => $request->input('ngay_nhap'),
                'mo_ta' => $request->input('mo_ta'),
                'hinh_anh' => $filePath,
                'trang_thai' => $request->input('trang_thai'),
                'created_at' => now(),
                'updated_at' => null,
            ];
            // kiểm tra xem đã lấy được dữ liệu lên chưa
            // dd($dataSanPham);
            // lưu dữ liệu database
            DB::table('san_phams')->insert($dataSanPham);

            DB::commit();

            return redirect()->route('sanphams.index')
            ->with('success','Thêm sản phẩm thành công');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('sanphams.index')
            ->with('error','Có lỗi khi thêm sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Tìm sản phẩm theo ID
    $sanPham = DB::table('san_phams')->find($id);

    // Nếu không tìm thấy sản phẩm, chuyển hướng về danh sách và báo lỗi
    if (!$sanPham) {
        return redirect()->route('sanphams.index')
            ->with('error', 'Sản phẩm không tồn tại');
    }

    // Trả về view chi tiết sản phẩm
    return view('admins.sanphams.show', compact('sanPham'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // lay ra du lieu cua san pham
        
        $sanPham = DB::table('san_phams')->find($id);
        if(!$sanPham){
            return redirect()->route('sanphams.index')
            ->with('error','San pham khong ton tai');

        }
        return view('admins.sanphams.edit',compact('sanPham'));

    }

    //hien thi giao dien sua du lieu
    public function update(AdminSanPhamRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $sanPham = DB::table('san_phams')->find($id);
            if(!$sanPham){
                return redirect()->route('sanphams.index')
                ->with('error','San pham khong ton tai');
    
            }
            //xử lý hình ảnh
            $filePath = $sanPham->hinh_anh;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('uploads/sanphams','public');
                //xoa hinh cu neu co hinh anh moi day len
                if($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)){
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }
            }
            //xử lý cap nhat giu lieu
            $dataSanPham = [
                'ten_san_pham' => $request->input('ten_san_pham'),
                'gia' => $request->input('gia'),
                'gia_khuyen_mai' => $request->input('gia_khuyen_mai'),
                'so_luong' => $request->input('so_luong'),
                'ngay_nhap' => $request->input('ngay_nhap'),
                'mo_ta' => $request->input('mo_ta'),
                'hinh_anh' => $filePath,
                'trang_thai' => $request->input('trang_thai'),
                'updated_at' => now(),
            ];
            // kiểm tra xem đã lấy được dữ liệu lên chưa
            // dd($dataSanPham);
            // lưu dữ liệu database
            DB::table('san_phams')->where('id', $id)->update($dataSanPham);

            DB::commit();

            return redirect()->route('sanphams.index')
            ->with('success','Cap nhat phẩm thành công');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('sanphams.index')
            ->with('error','Có lỗi khi cap nhat');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        $sanPham = DB::table('san_phams')->find($id);
        if(!$sanPham){
            return redirect()->route('sanphams.index')
            ->with('error','San pham khong ton tai');

        }

        //luu giu tam thoi duong dan cua hinh anh vao day
        $filePath = $sanPham->hinh_anh;
        
        $deleteSanPham = DB::table('san_phams')->where('id',$id)->delete();

        if($deleteSanPham){
            if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                  Storage::disk('public')->delete($filePath);
            }
            return redirect()->route('sanphams.index')
            ->with('success','xoa san phẩm thành công');
          
        }
        return redirect()->route('sanphams.index')
        ->with('error','Co loi khi xoa');
    }
}
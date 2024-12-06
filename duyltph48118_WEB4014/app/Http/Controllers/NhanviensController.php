<?php

namespace App\Http\Controllers;

use App\Models\nhanviens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorenhanviensRequest;
use App\Http\Requests\UpdatenhanviensRequest;

class NhanviensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = DB::table('nhan_viens')->orderByDesc('id');
        $key = $request->input('key');
        if ($key) {
            $query->where(function ($query) use ($key) {
                #
                $query->where('ma_nhan_vien', 'like', "%$key%")
                    ->orwhere('ten_nhan_vien', 'like', "%$key%");
            });
        }
        $listNhanVien = $query->paginate('2');
        return view('admins.nhanviens.index', compact('listNhanVien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admins.nhanviens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        try {
        $filePath = null;
        if ($request->hasFile('hinh_anh')) {
            $filePath = $request->file('hinh_anh')->store('uploads/nhanviens', 'public');
        }
            $dataNhanVien = [
                'ma_nhan_vien' => $request->input('ma_nhan_vien'),
                'ten_nhan_vien' => $request->input('ten_nhan_vien'),
                'hinh_anh' => $filePath,
                'ngay_vao_lam' => $request->input('ngay_vao_lam'),
                'luong' => $request->input('luong'),
                'trang_thai' => $request->input('trang_thai'),
                'created_at' => now(),
                'updated_at' => null,
            ];
             DB::table('nhan_viens')->insert($dataNhanVien);

             DB::commit();
 
             return redirect()->route('nhanviens.index')
             ->with('success','Thêm mới nhân viên thành công');
        
    }catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('nhanviens.index')
            ->with('error','Có lỗi khi thêm nhân viên');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(nhanviens $nhanviens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(nhanviens $nhanviens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenhanviensRequest $request, nhanviens $nhanviens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $nhanVien = DB::table('nhan_viens')->find($id);
        if(!$nhanVien){
            return redirect()->route('nhanviens.index')
            ->with('error','Nhân viên không tồn tại');

        }

        //luu giu tam thoi duong dan cua hinh anh vao day
        $filePath = $nhanVien->hinh_anh;
        
        $deletenhanVien = DB::table('nhan_viens')->where('id',$id)->delete();

        if($deletenhanVien){
            if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                  Storage::disk('public')->delete($filePath);
            }
            return redirect()->route('nhanviens.index')
            ->with('success','Xóa nhân viên thành công');
          
        }
        return redirect()->route('nhanviens.index')
        ->with('error','Có lỗi khi xóa');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BaiVietResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBaiVietRequest;
use App\Http\Requests\UpdateBaiVietRequest;
use Symfony\Component\Mime\Part\MessagePart;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //lấy ra danh sách toàn bộ bài viết
        //Sử dụng Eloquent để truy xuất dữ liệu
        // Để sử dụng đc eloquent bát buộc phải có model
        $baiViets = BaiViet::all();
        // dd($baiViets);


        // trả về thông tin bài viết dưới dạng JSON
        return BaiVietResource::collection($baiViets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBaiVietRequest $request)
    {
        $filePath = null;
        if($request->hasFile('hinh_anh')){
            $filePath = $request->file('hinh_anh')->store('uploads/baiviets','public');
        }
        //xử lý thêm dữ liệu
        $dataSanPham = [
            'hinh_anh'=> $filePath,
            'tieu_de' => $request->input('tieu_de'),
            'noi_dung' => $request->input('noi_dung'),
            'ngay_dang' => $request->input('ngay_dang'),
            'trang_thai' => $request->input('trang_thai'),
          
        ];
        // kiểm tra xem đã lấy được dữ liệu lên chưa
        // dd($dataSanPham);
        // lưu dữ liệu database
        $newBaiViet = BaiViet::create($dataSanPham);
        return response()->json([
          'message' => 'Thêm bài viết thành công',
          'data'    => new BaiVietResource($newBaiViet)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BaiViet $baiviet)
    {
        if ($$baiviet){
          return new BaiVietResource($$baiviet);
        }else{
           return response()->json([
             'message' => 'Bài viết không tồn tại'
           ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBaiVietRequest $request, BaiViet $baiviet)
    {
    
            // if(!$baiViet){
            //     return redirect()->route('sanphams.index')
            //     ->with('error','San pham khong ton tai');
    
            // }
            //xử lý hình ảnh
            $filePath = $baiviet->hinh_anh;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('uploads/baiviets','public');
                //xoa hinh cu neu co hinh anh moi day len
                if($baiviet->hinh_anh && Storage::disk('public')->exists($baiviet->hinh_anh)){
                    Storage::disk('public')->delete($baiviet->hinh_anh);
                }
            }
            //xử lý cap nhat giu lieu
            $dataBaiViet= [
                'hinh_anh' => $filePath,
                'tieu_de' => $request->input('tieu_de'),
                'noi_dung' => $request->input('noi_dung'),
                'ngay_dang' => $request->input('ngay_dang'),
                'trang_thai' => $request->input('trang_thai'),
               
            ];
            $baiviet->update($dataBaiViet);
            return response()->json([
              'message' => 'Sửa bài viết thành công',
              'data'    => new BaiVietResource($baiviet)
            ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaiViet $baiviet)
    {
        if(!$baiviet){
            return response()->json(['message'=>'không tìm thấy bài viết']);
        }

        //luu giu tam thoi duong dan cua hinh anh vao day
        $filePath = $baiviet->hinh_anh;
        
        $deletbaiviet = $baiviet->delete();

        if($deletbaiviet){
            if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                  Storage::disk('public')->delete($filePath);
            }
            return response()->json(['message'=>'xóa bài viết thành công']);
          
        }
        return response()->json(['message'=>'xóa bài viết thất bại']);
    }
}

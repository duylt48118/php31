<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSinhVienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->sinhvien); 
        return [
            'ma_sinh_vien'=>'required|max:20|unique:sinhviens,ma_sinh_vien,' .$this->sinhvien,
            'ten_sinh_vien'=>'required|max:20',             
            'so_dien_thoai' =>'required|min:0',
            'ngay_sinh' =>'required|date',
            'trang_thai'=>'required|in:0,1',
            'hinh_anh' =>'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }
    public function messages(): array
    {
        return [
            'ma_sinh_vien.required'  => 'Mã sinh viên phẩm bắt buộc điền.',
            'ma_sinh_vien.unique'    => 'Mã sinh viên phẩm không được trùng.',
            'ma_sinh_vien.max'       => 'Mã sinh viên phẩm quá dài.',

            'ten_sinh_vien.required' => 'Tên sinh viên phẩm bắt buộc điền.',
            'ten_sinh_vien.max'      => 'Tên sinh viên phẩm quá dài',

            

            'so_dien_thoai.required'     => 'Số điện thoại  bắt buộc điền.',
            // 'so_dien_thoai.integer'     => 'Số điện thoại  phải là một số .',
            'so_dien_thoai.min'          => 'Số điện thoại  không hợp lệ.',

            'ngay_sinh.required'    => 'Ngày  bắt buộc điền.',
            'ngay_sinh.date'        => 'Ngày  không hợp lệ.',

            'trang_thai.required'            => 'Trạng thái bắt buộc điền.',
            
            'hinh_anh.image'              => 'Hình ảnh không hợp lệ.'
        ];
    }
}

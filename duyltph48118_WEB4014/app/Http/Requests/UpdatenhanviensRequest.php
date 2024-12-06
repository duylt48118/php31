<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatenhanviensRequest extends FormRequest
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
        return [
            //
            'ten_nhan_vien'=>'required|max:20|unique:san_phams,ma_san_pham,' .$this->sanpham,
            'ten_san_pham'=>'required|max:20', 
            'gia'         =>'required|numeric|min:0|max:99999999',
            'gia_khuyen_mai' =>'nullable|numeric|min:0|lt:gia',
            'so_luong' =>'required|integer|min:0',
            'ngay_nhap' =>'required|date',
            'mo_ta'   =>'nullable|string',
            'trang_thai'=>'required|in:0,1',
            'hinh_anh' =>'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }
}

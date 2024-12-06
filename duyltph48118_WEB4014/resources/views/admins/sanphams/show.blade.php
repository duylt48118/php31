@extends('layouts.admin')

@section('content')
@section('title')
    Quản lý sản phẩm
@endsection

@section('CSS')
<style>
    .product-card {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        line-height: 1.8;
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
        border-radius: 5px;
        padding: 10px 15px;
    }

    .btn-back:hover {
        background-color: #5a6268;
        text-decoration: none;
        color: white;
    }

    h1 {
        margin-bottom: 20px;
        color: #343a40;
    }
</style>
@endsection

<div class="container-fluid">
    <h1 class="text-center">Chi Tiết Sản Phẩm</h1>
    <div class="mb-3">
        <a href="{{ route('sanphams.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
    </div>
    <div class="product-card">
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($sanPham->hinh_anh)
                    <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" alt="Hình ảnh sản phẩm" class="img-fluid" width="300">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="Không có hình ảnh" class="img-fluid" width="300">
                @endif
            </div>
            <div class="col-md-8">
                <div class="product-details">
                    <h5><strong>Mã Sản phẩm:</strong> {{ $sanPham->ma_san_pham }}</h5>
                    <p><strong>Tên Sản phẩm:</strong> {{ $sanPham->ten_san_pham }}</p>
                    <p><strong>Giá:</strong> {{ number_format($sanPham->gia, 0, ',', '.') }} VND</p>
                    @if($sanPham->gia_khuyen_mai)
                        <p><strong>Giá Khuyến mãi:</strong> 
                        <span class="text-danger">{{ number_format($sanPham->gia_khuyen_mai, 0, ',', '.') }} VND</span>
                        </p>
                    @endif
                    <p><strong>Số Lượng:</strong> {{ $sanPham->so_luong }}</p>
                    <p><strong>Ngày Nhập:</strong> {{ $sanPham->ngay_nhap }}</p>
                    <p><strong>Mô tả:</strong> {!! $sanPham->mo_ta !!}</p>
                    <p><strong>Trạng Thái:</strong> 
                    <span class="{{ $sanPham->trang_thai ? 'text-success' : 'text-danger' }}">
                        {{ $sanPham->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                    </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

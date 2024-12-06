@extends('layouts.admin')

@section('content')
@section('CSS')
<style>
    .student-detail-card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .student-detail-card h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #343a40;
    }

    .student-detail-card .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        border-radius: 5px;
        color: white;
        padding: 10px 15px;
        font-size: 14px;
    }

    .student-detail-card .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #fff;
    }

    .student-detail-card img {
        border-radius: 10px;
        width: 200px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .student-detail-card .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .student-detail-card .card-text {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .student-detail-card .card-text strong {
        font-weight: bold;
        color: #555;
    }
</style>
@endsection

<div class="container mt-4">
    <div class="student-detail-card">
        <h1>Chi Tiết Sinh Viên</h1>
        <a href="{{ route('sinhviens.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Quay lại danh sách</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mã Sinh Viên: <span class="text-primary">{{ $sinhVien->ma_sinh_vien }}</span></h5>
                <p class="card-text"><strong>Tên Sinh Viên:</strong> {{ $sinhVien->ten_sinh_vien }}</p>
                <p class="card-text"><strong>Ngày Sinh:</strong> {{ $sinhVien->ngay_sinh }}</p>
                <p class="card-text"><strong>Số Điện Thoại:</strong> {{ $sinhVien->so_dien_thoai }}</p>
                <p class="card-text"><strong>Trạng Thái:</strong> 
                    <span class="{{ $sinhVien->trang_thai ? 'text-success' : 'text-danger' }}">
                        {{ $sinhVien->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </p>
                @if ($sinhVien->hinh_anh)
                    <p><strong>Hình Ảnh:</strong></p>
                    <img src="{{ asset('storage/' . $sinhVien->hinh_anh) }}" alt="Hình ảnh của sinh viên" class="img-thumbnail">
                @else
                    <p><strong>Hình Ảnh:</strong> <span class="text-muted">Không có hình ảnh</span></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

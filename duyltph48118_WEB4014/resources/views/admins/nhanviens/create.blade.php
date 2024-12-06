{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý nhân viên
@endsection

@section('CSS')
@endsection

{{-- @section: dùng để chị định phần nội dụng được hiển thị --}}
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý nhân viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới nhân viên</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thêm mới nhân viên</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('nhanviens.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <label for="ma_nhan_vien" class="form-label">Mã nhân viên</label>
                                                <input type="text" class="form-control "
                                                 name="ma_nhan_vien"
                                                    id="ma_nhan_vien" value="{{ strtoupper(Str::random(10))}}" readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label for="ten_nhan_vien" class="form-label">Tên nhân viên</label>
                                            <input type="text" class="form-control"
                                                 name="ten_nhan_vien"
                                                    id="ten_nhan_vien" placeholder="Nhập tên nhân viên" 
                                                    value="{{ old('ten_nhan_vien') }}">
                                            </div>

                                            <div class="mt-3">
                                                <label for="ngay_vao_lam" class="form-label">Ngày vào làm</label>
                                                <input type="date" class="form-control" name="ngay_vao_lam" id="ngay_vao_lam" value="0"
                                           
                                                value="{{ old('ngay_vao_lam') }}">
                                                 
                                            </div>

                                            <div class="mt-3">
                                                <label for="luong" class="form-label">Lương</label>
                                                <input type="number" class="form-control" name="luong" id="luong
                                                "value="{{ old('so_luong') }}">
                        
                                            </div>


                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="mt-3">
                                                    <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                                    <input type="file" class="form-control"name="hinh_anh"
                                                        id="hinh_anh" value="{{ old('hinh_anh') }}"> 
                                                </div>

                                                

                                                <div class="mt-3">
                                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                                    <div>
                                                        <input type="radio" name="trang_thai" id="trang_thai_hien_thi"
                                                       
                                                            value="1" class="form-check-input" value="{{ old('trang_thai') }}">
                                                            
                                                        <label for="trang_thai_hien_thi" class="form-check-label">
                                                            Hiển thị
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="trang_thai"
                                                            id="trang_thai_khong_hien_thi" value="0"
                                                             value="{{ old('trang_thai') }}"
                                                            class="form-check-input">
                                                            
                                                         
                                                        <label for="trang_thai_khong_hien_thi" class="form-check-label">
                                                            Không hiển thị
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end col-->
                            </div>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card -->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    </div>
@endsection

@section('JS')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection
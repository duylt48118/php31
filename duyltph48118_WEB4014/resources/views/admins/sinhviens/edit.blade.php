{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sản phẩm
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
                    <h4 class="mb-sm-0">Quản lý sinh viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Sửa sinh viên</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Sua sinh viên</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('sinhviens.update', $sanPham->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <label for="ma_sinh_vien" class="form-label">Mã sinh viên</label>
                                                <input type="text" class="form-control " name="ma_sinh_vien"
                                                    id="ma_sinh_vien" value="{{ $sanPham->ma_sinh_vien }}" readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label for="ten_sinh_vien" class="form-label">Tên sinh viên</label>
                                                <input type="text"
                                                    class="form-control @error('ten_sinh_vien') is-invalid @enderror"
                                                    name="ten_sinh_vien" id="ten_sinh_vien" placeholder="Nhập tên sản phẩm"
                                                    value="{{ $sanPham->ten_sinh_vien }}">

                                                @error('ten_sinh_vien')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>



                                            <div class="mt-3">
                                                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                                <input type="text"
                                                    class="form-control      @error('so_dien_thoai') is-invalid @enderror"
                                                    name="so_dien_thoai" id="so_dien_thoai"
                                                    value="{{ $sanPham->so_dien_thoai }}">
                                                @error('so_dien_thoai')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="ngay_sinh" class="form-label">Ngày nhập</label>
                                                <input type="date"
                                                    class="form-control @error('ngay_sinh') is-invalid @enderror"
                                                    name="ngay_sinh"
                                                    id="ngay_sinh
                                                "value="{{ $sanPham->ngay_sinh }}">
                                                @error('ngay_sinh')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="mt-3">
                                                    <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                                    <input type="file"
                                                        class="form-control @error('hinh_anh') is-invalid @enderror"
                                                        name="hinh_anh" id="hinh_anh" value="{{ old('hinh_anh') }}">
                                                    @error('hinh_anh')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    <img src="{{ Storage::url($sanPham->hinh_anh) }}" alt=""
                                                        style="width:100px">
                                                </div>



                                                <div class="mt-3">
                                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                                    <div>
                                                        <input type="radio" name="trang_thai" id="trang_thai_hien_thi"
                                                            @error('trang_thai') is-invalid @enderror value="1"
                                                            class="form-check-input">
                                                        @error('trang_thai')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                        <label for="trang_thai_hien_thi" class="form-check-label">
                                                            Hiển thị
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="trang_thai"
                                                            id="trang_thai_khong_hien_thi" value="0"
                                                            @error('trang_thai') is-invalid @enderror
                                                            class="form-check-input">
                                                        @error('trang_thai')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                        <label for="trang_thai_khong_hien_thi" class="form-check-label">
                                                            Không hiển thị
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-primary" type="submit">Sua</button>
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
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection

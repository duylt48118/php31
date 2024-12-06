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
                            
                            <li class="breadcrumb-item active">Danh sách nhân viên</li>
                        </ol>
                    </div>
                    <form action=""method="POST">
                        
                    </form>

                </div>
            </div>
            
        </div>
        <!-- end page title -->
     
        <div class="row">
            <form action="{{ route('nhanviens.index') }}" method="GET" class="mt-3 d-flex ms-3 ">
                <div class="form-group mx-2">
                    <input type="text" class="form-control" name="key" value="{{ request('key') }}" placeholder="Mã nhân viên / Tên nhân viên" style="width:250px">
                </div>
                <button type="submit" class="btn btn-primary">Tìm</button>
                <a href="{{ route('nhanviens.index') }}" class="btn btn-danger mx-2">Xóa</a>
            </form>
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Danh sách nhân viên</h4>
                            <a href="{{ route('nhanviens.create') }}" class="btn btn-soft-success material-shadow-none">
                                <i class="ri-add-circle-line align-middle me-1"></i>
                                Thêm nhân viên
                            </a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            

   
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Mã nhân viên</th>
                                                <th scope="col">Tên nhân viên</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Ngày vào làm</th>
                                                <th scope="col">Lương</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listNhanVien as $key => $nhanVien)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $nhanVien->ma_nhan_vien }}</td>
                                                    <td>{{ $nhanVien->ten_nhan_vien}}</td>
                                                    <td>
                                                        <img src="{{Storage::url($nhanVien->hinh_anh)}}" class="img-thumbnail" alt="Hình ảnh" width="100px">
                                                    </td>
                                                    <td>{{ $nhanVien->ngay_vao_lam}}</td>
                                                    <td>{{ number_format($nhanVien->luong, 0, '', '.') }} VNĐ</td>
                                                    <td>
                                                        @if ($nhanVien->trang_thai == 1)
                                                            <span
                                                                class="badge bg-success-subtle text-success text-uppercase">Hoạt động
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger-subtle text-danger text-uppercase">Không hoạt động
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary">Xem</a>
                                                        <a href="{{route('nhanviens.edit', $nhanVien->id)}}" class="btn btn-sm btn-warning">Sửa</a>
                                                        <form action="{{route('nhanviens.destroy',$nhanVien->id)}}" method="POST"
                                                            onsubmit="return confirm('Xac nhan xoa nhan vien')" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">Xóa</button>
                                                        </form>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $listNhanVien->links('pagination::bootstrap-5') }}
                                    </div>
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
@endsection
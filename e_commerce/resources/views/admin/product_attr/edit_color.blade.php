@extends('layouts.admin')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cập nhật màu sắc</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0 text-primary">Cập nhật màu sắc</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.product_attr.update_color', $color->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <li>Màu sắc phải có dữ liệu</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <div class="append-product-attr">
                                            <div class="color">
                                                <div class="form-group">
                                                    <label class="form-label">Color</label>
                                                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ $color->name }}" placeholder="Color: Black, White, Blue, ...">
                                                    @error('color')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-2"><i class="fadeIn animated bx bx-plus"></i> Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('custom_js')

@endsection

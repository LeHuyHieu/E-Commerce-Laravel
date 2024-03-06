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
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0 text-primary">Thêm sản phẩm mới</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0 text-center">
                                            <li>Vui long kiểm tra lại dữ liệu</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control get-slug @error('name') is-invalid @enderror" placeholder="Tên sản phẩm" name="name" value="{{ old('name') }}" id="inputName">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="inputCategory" class="form-label">Danh mục</label>
                                    <select id="inputCategory" name="category_id" class="single-select @error('category_id') is-invalid @enderror">
                                        <option value="0" selected>Choose...</option>
                                        @foreach($categories as $category)
                                            @if($category['parent_id'] == 0)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ '-- '.$category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="inputDiscount" class="form-label">Kiểu sản phẩm</label>
                                    <select id="inputDiscount" name="product_type" class="single-select @error('product_type') is-invalid @enderror">
                                        <option value="0" selected>Default</option>
                                        <option value="hot">Hot</option>
                                        <option value="sale">Sale</option>
                                        <option value="new">New</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                    @error('product_type')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 ms-auto col-12 show-discount-percent d-none">
                                    <label for="" class="form-label">Phần trăm giảm giá</label>
                                    <input type="text" class="form-control @error('discount_percent') is-invalid @enderror" name="discount_percent" {{ old('discount_percent') }} placeholder="Vd: 18.9">
                                    @error('discount_percent')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-12 show-sale-product d-none">
                                    <label for="" class="form-label">Thời gian sale</label>
                                    <input type="datetime-local" class="form-control @error('time_sale') is-invalid @enderror" {{ old('time_sale') }} name="time_sale">
                                    @error('time_sale')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea id="description" class="text-editor @error('description') is-invalid @enderror" name="description" placeholder="Mô tả sản phẩm">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_before" class="form-label">Ảnh trước</label>
                                        <input type="file" class="form-control img_inp @error('image_before') is-invalid @enderror" name="image_before" value="{{ old('image_before') }}">
                                        @error('image_before')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                        <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_after" class="form-label">Ảnh sau</label>
                                        <input type="file" class="form-control img_inp @error('image_after') is-invalid @enderror" name="image_after" value="{{ old('image_after') }}">
                                        @error('image_after')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                        <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="form-label">Giá thành</label>
                                        <input type="text" data-type="currency" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Vd: 130.000 VND">
                                        @error('price')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity" class="form-label">Số lượng</label>
                                        <input type="text" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" placeholder="Số lượng tồn">
                                        @error('quantity')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Ảnh chi tiết</label>
                                    <div class="border rounded border-1 p-3">
                                        <div class="list-image mb-3"></div>
                                        <button class="btn btn-primary btn-add-image-item btn-sm" type="button"><i class="lni lni-circle-plus"></i> Add image</button>
                                    </div>
                                    @error('list_image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-2"><i class="fadeIn animated bx bx-plus"></i> Create Category</button>
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
    <div class="d-none">
        <div class="form-group clone-item">
            <label for="list_image" class="file" style="cursor: pointer;">
                <input type="file" name="list_image[]" id="list_image" class="img_inp d-none">
                <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="show_image" alt="">
            </label>
            <span class="btn-remove" style="cursor: pointer;"><i class="lni lni-trash"></i></span>
        </div>
    </div>
@endsection

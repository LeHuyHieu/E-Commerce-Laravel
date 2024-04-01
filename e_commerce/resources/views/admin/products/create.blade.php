@extends('layouts.admin')
{{-- custom css --}}
@section('custom_css')
    <style>
        .btn-remove-product-info {
            position: absolute;
            top: -10px;
            right: 15px;
            width: 30px;
            height: 30px;
            background: #fff;
        }
    </style>
@endsection

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
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <form class="row g-3" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                        {{-- product --}}
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body py-4">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0 text-primary">Thêm sản phẩm mới</h5>
                                </div>
                                <hr>
                                <div class="row">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0 text-center">
                                                <li>Vui long kiểm tra lại dữ liệu</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="inputName" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Tên sản phẩm" name="name" value="{{ old('name') }}" id="inputName">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="inputCategory" class="form-label">Danh mục</label>
                                            <select id="inputCategory" name="category_id"
                                                class="single-select @error('category_id') is-invalid @enderror">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($categories as $category)
                                                    @if ($category['parent_id'] == 0)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ '-- ' . $category->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="inputProductType" class="form-label">Kiểu sản phẩm</label>
                                            <select id="inputProductType" name="product_type" class="single-select @error('product_type') is-invalid @enderror">
                                                <option value="default" selected>Default</option>
                                                <option value="hot">Hot</option>
                                                <option value="sale">Sale</option>
                                                <option value="new">New</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                        </div>
                                        @error('product_type')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="inputBranch" class="form-label">Branch</label>
                                            <select id="inputBranch" name="branch_id"
                                                class="single-select @error('branch_id') is-invalid @enderror">
                                                @foreach ($branchs as $branch)
                                                    @if ($branch['parent_id'] == 0)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @else
                                                        <option value="{{ $branch->id }}">{{ '-- ' . $branch->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="append-product-type"></div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea id="description" class="text-editor @error('description') is-invalid @enderror" name="description" placeholder="Mô tả sản phẩm">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image_before" class="form-label">Ảnh trước</label>
                                            <input type="file" class="form-control img_inp @error('image_before') is-invalid @enderror" name="image_before" value="{{ old('image_before') }}">
                                            @error('image_before')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                            <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="image_after" class="form-label">Ảnh sau</label>
                                            <input type="file" class="form-control img_inp @error('image_after') is-invalid @enderror" name="image_after" value="{{ old('image_after') }}">
                                            @error('image_after')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                            <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label">Giá thành</label>
                                            <input type="text" data-type="currency" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Vd: 130.000 VND">
                                            @error('price')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Ảnh chi tiết</label>
                                            <div class="border rounded border-1 p-3">
                                                <div class="list-image mb-3"></div>
                                                <button class="btn btn-primary radius-30 btn-add-image-item btn-sm" type="button"><i class="bx bx-image-add"></i> Thêm</button>
                                            </div>
                                            @error('list_image')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end product --}}
                        {{-- product info --}}
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body py-4">
                                <div
                                    class="card-title d-flex align-items-center justify-content-between border-bottom border-primary">
                                    <h6 class="mb-0 text-primary">Thông tin SP</h6>
                                </div>
                                <div class="card-body">
                                    @error('additional_infos')
                                        <span class="invalid-feedback d-block text-center">Vui long kiem tra lại thong tin</span>
                                    @enderror
                                    <div class="row mb-3 position-relative product-info-item">
                                        <button type="button"
                                            class="btn text-danger btn-remove-product-info btn-sm radius-30"><i
                                                class="bx bx-x-circle"></i></button>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                            <div class="form-group py-2">
                                                <label for="" class="form-label">Thuộc tính</label>
                                                <input type="text" name="additional_infos[key][]" class="form-control" placeholder="Vd: Màu sắc, ...">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                            <div class="form-group py-2">
                                                <label for="" class="form-label">Giá trị</label>
                                                <input type="text" name="additional_infos[value][]" class="form-control" placeholder="Vd: Xanh, đỏ, tím, vàng, ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="append-product-info"></div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-end">
                                                <button type="button" class="btn btn-primary btn-clone-product-info radius-30 btn-sm"><i class="bx bx-plus-circle"></i> Thêm thông tin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end product info --}}
                        {{-- product detail --}}
                        <div class="card border-top border-0 border-4 border-primary product-detail-item">
                            <div class="card-body py-4">
                                <div class="card-title d-flex align-items-center justify-content-between border-bottom border-primary">
                                    <h6 class="mb-0 text-primary">Sản phẩm chi tiết</h6>
                                    <button type="button" class="btn btn-remove-product-detail text-danger btn-sm radius-30"><i class="bx bx-x-circle"></i></button>
                                </div>
                                <div class="row">
                                    @error('product_variants')
                                        <span class="invalid-feedback d-block text-center">Vui long kiem tra lại thong tin</span>
                                    @enderror
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="colorId" class="form-label">Màu</label>
                                            <select name="product_variants[color_id][]" id="colorId" class="form-select">
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="sizeId" class="form-label">Size</label>
                                            <select name="product_variants[size_id][]" id="sizeId" class="form-select">
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Số lượng</label>
                                            <input type="text" name="product_variants[quantity][]" class="form-control" placeholder="Số lượng: 1">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="priceVariant" class="form-label">Giá</label>
                                            <input type="text" data-type="currency" id="priceVariant" name="product_variants[price][]" class="form-control" placeholder="Vd: 130.000 VND">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="imageVariant" class="form-label">Ảnh</label>
                                            <input type="file" id="imageVariant" name="product_variants[image][]" class="form-control img_inp">
                                            <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="append-product-detail"></div>
                        {{-- end product detail --}}
                        <div class="card border-top border-0 border-4 border-primary position-sticky" style="bottom: 50px;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-end py-3">
                                        <button type="button" class="btn btn-primary btn-clone-product-detail radius-30 btn-sm"><i class="bx bx-list-plus"></i> Thêm SP</button>
                                        <button type="submit" class="btn btn-primary px-2 radius-30 btn-sm"><i class="bx bx-plus-circle"></i> Thêm mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
    {{-- list product --}}
    <div class="d-none">
        <div class="form-group clone-item">
            <label for="list_image" class="file" style="cursor: pointer;">
                <input type="file" name="list_image[]" id="list_image" class="img_inp d-none">
                <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="show_image" alt="">
            </label>
            <span class="btn-remove" style="cursor: pointer;"><i class="lni lni-trash"></i></span>
        </div>
    </div>
    {{-- list product --}}
    {{-- type product --}}
    <div class="d-none">
        <div class="show-sale-product row">
            <div class="col-md-3 ms-auto col-12 show-discount-percent">
                <label for="" class="form-label">Phần trăm giảm giá</label>
                <input type="text" class="form-control @error('discount_percent') is-invalid @enderror" name="discount_percent" value="{{ old('discount_percent') }}" placeholder="Vd: 18.9">
                @error('discount_percent')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 col-12">
                <label for="" class="form-label">Thời gian sale</label>
                <input type="datetime-local" class="form-control @error('time_sale') is-invalid @enderror" value="{{ old('time_sale') }}" name="time_sale">
                @error('time_sale')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    {{-- end type product --}}
    {{-- product info --}}
    <div class="d-none">
        <div class="row mb-3 position-relative product-info">
            <button type="button" class="btn text-danger btn-remove-product-info btn-sm radius-30"><i class="bx bx-x-circle"></i></button>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                <div class="form-group py-2">
                    <label for="" class="form-label">Thuộc tính</label>
                    <input type="text" name="additional_infos[key][]" class="form-control" placeholder="Vd: Màu sắc, ...">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                <div class="form-group py-2">
                    <label for="" class="form-label">Giá trị</label>
                    <input type="text" name="additional_infos[value][]" class="form-control" placeholder="Vd: Xanh, đỏ, tím, vàng, ...">
                </div>
            </div>
        </div>
    </div>
    {{-- product info --}}
    {{-- product detail --}}
    <div class="d-none">
        <div class="card border-top border-0 border-4 border-primary product-detail">
            <div class="card-body py-4">
                <div class="card-title d-flex align-items-center justify-content-between border-bottom border-primary">
                    <h6 class="mb-0 text-primary">Sản phẩm chi tiết</h6>
                    <button type="button" class="btn btn-remove-product-detail text-danger btn-sm radius-30"><i class="bx bx-x-circle"></i></button>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="form-group mb-3">
                            <label for="colorId" class="form-label">Màu</label>
                            <select name="product_variants[color_id][]" id="colorId" class="form-select">
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="form-group mb-3">
                            <label for="sizeId" class="form-label">Size</label>
                            <select name="product_variants[size_id][]" id="sizeId" class="form-select">
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="text" name="product_variants[quantity][]" class="form-control" placeholder="Số lượng: 1">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="form-group mb-3">
                            <label for="priceVariant" class="form-label">Giá</label>
                            <input type="text" data-type="currency" id="priceVariant" name="product_variants[price][]" class="form-control" placeholder="Vd: 130.000 VND">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <div class="form-group mb-3">
                            <label for="imageVariant" class="form-label">Ảnh</label>
                            <input type="file" id="imageVariant" name="product_variants[image][]" class="form-control img_inp" />
                            <img src="{{ asset('backend/assets/images/avatars/no_image.png') }}" width="100px" class="mt-3 show_image rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end product detail --}}
@endsection
{{-- custom js --}}
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#inputProductType').on('change', function() {
                var sale = $('.show-sale-product').clone()
                var percent = $('.show-discount-percent').clone()
                $('.append-product-type').empty()
                switch ($(this).val()) {
                    case 'sale':
                        $('.append-product-type').append(sale)
                        break;
                    case 'percent':
                        $('.append-product-type').append(percent)
                        break;
                    default:
                        $('.append-product-type').empty()
                        break;
                }
            })

            //clone
            function cloneItem(event, button, clone, removeClass, addClass, append) {
                var cloneItem = $(document).on(event, `.${button}`, function() {
                    var cloneItem = $(`.${clone}`).clone().removeClass(removeClass).addClass(addClass)
                    $(`.${append}`).append(cloneItem)
                })
            }

            cloneItem('click', 'btn-clone-product-info', 'product-info', 'product-info', 'product-info-item','append-product-info')
            cloneItem('click', 'btn-clone-product-detail', 'product-detail', 'product-detail', 'product-detail-item', 'append-product-detail')


            //remove
            function removeItem(event, button, parentItem) {
                $(document).on(event, `.${button}`, function() {
                    $(this).closest(`.${parentItem}`).remove()
                })
            }

            removeItem('click', 'btn-remove-product-info', 'product-info-item')
            removeItem('click', 'btn-remove-product-detail', 'product-detail-item')
        })
    </script>
@endsection

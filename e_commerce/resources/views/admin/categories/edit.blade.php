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
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                                <h5 class="mb-0 text-primary">Create Category</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.categories.update', $category_item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-7">
                                    <label for="inputCity" class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $category_item->name }}" id="inputName">
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="inputCategory" class="form-label">Categories</label>
                                    <select id="inputCategory" name="parent_id" class="single-select @error('parent_id') is-invalid @enderror">
                                        <option value="0">Choose...</option>
                                        @foreach($categories as $category)
                                            @if($category['parent_id'] == 0)
                                                <option value="{{ $category->id }}" {{ $category->id == ($category_item->parent->id ?? '') ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }} {{ $category->id == ($category_item->parent->id ?? '') ? 'selected' : '' }}">{{ '-- '.$category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" id="image" value="{{ old('image') ?? $category_item->image }}" class="form-control mb-3 @error('image') is-invalid @enderror" name="image"/>
                                    @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <label for="image" style="cursor: pointer;">
                                        <img src="{{ old('image') ?? (!empty($category_item->image) ? asset('uploads/admin/categories/'.$category_item->image) : asset( 'backend/assets/images/avatars/no_image.png')) }}" class="img-fluid" width="100px" alt="image" id="blah">
                                    </label>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-2">
                                        <i class="fadeIn animated bx bx-plus"></i> Update Category
                                    </button>
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
    <script>
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection

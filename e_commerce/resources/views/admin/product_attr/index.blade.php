@extends('layouts.admin')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Tables</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Table Attribute</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.product_attr.create') }}" class="btn btn-primary btn-sm"><i class="fadeIn animated bx bx-plus"></i> Create</a>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <h5>Màu sắc</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Tên</th>
                                        <th width="150px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $key => $color)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $color->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.product_attr.edit_color', $color->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form class="d-inline-block" action="{{ route('admin.product_attr.destroy_color', $color->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-delete-item btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <h5>Kích thước</h5>
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th width="50px">#</th>
                                    <th>Tên</th>
                                    <th width="150px">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sizes as $key => $size)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $size->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.product_attr.edit_size', $size->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form class="d-inline-block" action="{{ route('admin.product_attr.destroy_size', $size->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-delete-item btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

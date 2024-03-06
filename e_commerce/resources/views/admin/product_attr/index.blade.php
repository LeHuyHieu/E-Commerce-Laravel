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
                    <a href="{{ route('admin.product_attr.create') }}" class="btn btn-primary btn-sm"><i
                            class="fadeIn animated bx bx-plus"></i> Create</a>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <div class="filter_category">
                        <form action="{{ route('admin.product_attr.index') }}" method="get" class="row justify-content-end">
                            <div class="col-md-5 col-sm-6 col-xs-12 col-12">
                                <div class="input-group mb-3">
                                    <input type="text" value="{{ request()->search }}" placeholder="Search" class="form-control" name="search"
                                        autocomplete="off" />
                                    <button type="submit" class="input-group-text" id="basic-addon1"><i
                                            class="fadeIn animated bx bx-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive row">
                        @include('admin.product_attr.component.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

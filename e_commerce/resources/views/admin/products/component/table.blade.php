<table id="table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th style="width: 50px;"><input type="checkbox" class="form-check-input" id="checkAll"></th>
        <th style="width: 50px;">Id</th>
        <th style="width: 250px;">Image</th>
        <th>Category</th>
        <th width="150px">Price</th>
        <th>Qtity</th>
        <th width="100px">Type</th>
        <th style="width: 140px;">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $product)
        <tr>
            <td><input type="checkbox" class="form-check-input" id="checkItem{{ $product->id }}"></td>
            <td>{{ $key + 1 }}</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="recent-product-img">
                        {!! (!empty($product->image)) ? '<img width="30px" class="img-fluid" src="'.asset('uploads/products/'.$product->image).'">' : 'No Image' !!}
                    </div>
                    <div class="ms-2">
                        <h6 class="mb-1 font-14">{{ $product->name }}</h6>
                    </div>
                </div>
            </td>
            <td>{{ $product->getNameCategoryId($product->category_id)->name }}</td>
            <td><h6 class="mb-1 font-14">{{ number_format($product->price) .' VND' }}</h6></td>
            <td>5</td>
            <td><div class="badge rounded-pill bg-light-info text-info w-100">Sale</div></td>
            <td>
                <a href="{{ route('admin.categories.edit', $product->id) }}" class="btn-primary btn btn-sm"><i class="fadeIn animated bx bx-edit"></i></a>
                <form class="d-inline-block" method="post" action="{{ route('admin.products.destroy', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger btn-delete-item btn btn-sm" data-id="{{ $product->id }}"><i class="fadeIn animated bx bx-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="float-end pagination-foot">
    {{ $products->links() }}
</div>

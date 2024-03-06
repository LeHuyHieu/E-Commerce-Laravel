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

<table id="table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="text-center" style="width: 50px;">Id</th>
        <th class="text-center">Image</th>
        <th class="text-center">Category name</th>
        <th class="text-center">Parent name</th>
        <th class="text-center" style="width: 140px;">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $key => $category)
        <tr>
            <td class="text-center">{{ $key + 1 }}</td>
            <td class="text-center">{!! (!empty($category->image)) ? '<img width="30px" class="img-fluid" src="'.asset('uploads/categories/'.$category->image).'">' : 'No Image' !!}</td>
            <td class="text-center">{{ $category->name }}</td>
            <td class="text-center">{{ $category->parent->name ?? '' }}</td>
            <td class="text-center">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-primary btn btn-sm"><i class="fadeIn animated bx bx-edit"></i></a>
                <form class="d-inline-block" method="post" action="{{ route('admin.categories.destroy', $category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger btn-delete-item btn btn-sm" data-id="{{ $category->id }}"><i class="fadeIn animated bx bx-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="float-end pagination-foot">
    {{ $categories->links() }}
</div>

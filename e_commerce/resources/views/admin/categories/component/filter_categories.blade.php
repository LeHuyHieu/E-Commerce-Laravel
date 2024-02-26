<div class="filter_category">
    <form action="" method="" class="row justify-content-end">
        <div class="col-md-3 col-sm-4 col-xs-12 col-12">
            <select class="single-select mb-3" name="category_id">
                <option value="" selected>Choose...</option>
                @foreach($allCategories as $category_item)
                    @if($category_item['parent_id'] == 0)
                        <option value="{{ $category_item->id }}" {{ request()->category_id == $category_item->id ? 'selected' : '' }}>{{ $category_item->name }}</option>
                    @else
                        <option value="{{ $category_item->id }}" {{ request()->category_id == $category_item->id ? 'selected' : '' }}>{{ '-- '.$category_item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-5 col-sm-6 col-xs-12 col-12">
            <div class="input-group mb-3">
                <input type="text" value="{{ request()->title }}" class="form-control" name="title" autocomplete="off"/>
                <button type="submit" class="input-group-text" id="basic-addon1"><i class="fadeIn animated bx bx-search"></i></button>
            </div>
        </div>
    </form>
</div>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Table Categories';
        $categories = Categories::paginate(2);
        return view('admin.categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Category';
        $categories = Categories::all();
        return view('admin.categories.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'numeric',
            'slug' => 'string',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);

        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        $data['slug'] = $request->slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin/categories'), $fileName);
            $data['image'] = $fileName;
        }
        Categories::create($data);
        Toastr::success('Insert successfully!', 'Success', ['closeButton' => true]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Category';
        $categories = Categories::all();
        $category_item = Categories::find($id);
        return view('admin.categories.edit', compact('title', 'categories', 'category_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'numeric',
            'slug' => 'string',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);
        $data = Categories::find($id);
        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->slug = $request->slug;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            @unlink('uploads/admin/categories/'.$data->image);
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin/categories'), $fileName);
            $data->image = $fileName;
        }
        $data->save();
        Toastr::success('Edit successfully!','Success', ['closeButton' => true]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categories::find($id)->delete();
//        Toastr::success('Delete successfully!', 'Success', ['closeButton' => true]);
        return redirect()->route('admin.categories.index');
    }
}

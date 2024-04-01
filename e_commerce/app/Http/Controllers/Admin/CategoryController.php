<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Table Category';

        //filter
        $categories = Category::where('status', 1);
        if (!empty($request->title))
        {
            $title = $request->title;
            $categories = $categories->where(function($query) use ($title) {
                $query->where('name', 'like', '%'.$title.'%');
                $query->orWhere('slug', 'like', '%'.$title.'%');
            });
        }

        if (!empty($request->category_id))
        {
            $category_id = $request->category_id;
            $categories = $categories->where('parent_id', '=', $category_id);
        }

        $categories = $categories->paginate(6)->withQueryString();

        $allCategories = Category::all();

        return view('admin.categories.index', compact('title', 'categories', 'allCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Category';
        $categories = Category::all();
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
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);

        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        $data['slug'] = Str::of($request->name)->slug('-');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/categories'), $fileName);
            $data['image'] = $fileName;
        }
        Category::create($data);
        $notification = array(
            'message' => 'Create category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories.index')->with($notification);
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
        $categories = Category::all();
        $category_item = Category::find($id);
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
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);
        $data = Category::find($id);
        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->slug = Str::of($request->name)->slug('-');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            @unlink('images/categories/'.$data->image);
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/categories'), $fileName);
            $data->image = $fileName;
        }
        $data->save();
        $notification = array(
            'message' => 'Update category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        $notification = array(
            'message' => 'Delete category successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories.index')->with($notification);
    }
}

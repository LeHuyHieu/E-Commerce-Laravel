<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductAttributeController extends Controller
{
    const LIMIT = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Product Attribute";
        $sizes = Size::where('name', 'like', "%$request->search%")->paginate(self::LIMIT);
        $colors = Color::where('name', 'like', "%$request->search%")->paginate(self::LIMIT);
        return view('admin.product_attr.index', compact('title', 'sizes', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Product Attribute";
        return view('admin.product_attr.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'color' => 'required_without:size|max:255|',
            'size' => 'required_without:color|max:255|',
        ];
        $message = [
            'required_without' => 'Màu hoặc kích thước phải có dữ liệu',
            'max' => ':attribute không được quá :max',
        ];
        $attribute = [
            'color' => 'Màu sắc',
            'size' => 'Kích thước'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();

            if (!empty($data['color'])) {
                Color::create(['name' => $data['color']]);
            } elseif (!empty($data['size'])) {
                Size::create(['name' => $data['size']]);
            }

            $notification = array(
                'message' => 'Tạo thành công',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.product_attr.index')->with($notification);
        }
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
    public function edit_color(string $id)
    {
        $title = "Edit Product Attribute";
        $color = Color::find($id);
        return view('admin.product_attr.edit_color', compact('title', 'color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_color(Request $request, string $id)
    {

        $rules = [
            'color' => 'required|max:255|',
        ];
        $message = [
            'required' => ':attribute phải có dữ liệu',
            'max' => ':attribute không được quá :max',
        ];
        $attribute = [
            'color' => 'Màu sắc',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();

            $color = Color::find($id);
            $color->name = $data['color'];
            $color->save();

            $notification = array(
                'message' => 'Cập nhật thành công',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.product_attr.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_color(string $id)
    {
        $color = Color::find($id);
        $color->delete();
        $notification = [
            'message' => 'Xóa màu sắc thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.product_attr.index')->with($notification);
    }

    //size
    public function edit_size(string $id)
    {
        $title = "Edit Product Attribute";
        $size = Size::find($id);
        return view('admin.product_attr.edit_size', compact('title', 'size'));
    }

    public function update_size(Request $request, string $id)
    {
        $rules = [
            'size' => 'required|max:255|',
        ];
        $message = [
            'required' => ':attribute phải có dữ liệu',
            'max' => ':attribute không được quá :max',
        ];
        $attribute = [
            'size' => 'Kích thước',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();

            $color = Size::find($id);
            $color->name = $data['size'];
            $color->save();

            $notification = array(
                'message' => 'Cập nhật thành công',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.product_attr.index')->with($notification);
        }
    }

    public function destroy_size(string $id)
    {
        $size = Size::find($id);
        $size->delete();
        $notification = [
            'message' => 'Xóa kích thước thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.product_attr.index')->with($notification);
    }
}

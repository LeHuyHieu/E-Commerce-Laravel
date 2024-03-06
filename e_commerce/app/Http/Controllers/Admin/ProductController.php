<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $products;
    const LIMIT = 15;
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Products";
        $products = Product::with('sizes','colors','variants', 'categories')->paginate(self::LIMIT)->withQueryString();
        return view('admin.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Product";
        $categories = Category::all();
        return view('admin.products.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['sku'] = '#'.date('His').rand(100, 999);
        $data['price'] = preg_replace("/[^0-9]/", "", $data['price']);
        if ($request->hasFile('image_before')) {
            $data['image_before'] = $this->uploadImage($request->file('image_before'));
        }

        if ($request->hasFile('image_after')) {
            $data['image_after'] = $this->uploadImage($request->file('image_after'));
        }

        if ($request->hasFile('list_image')) {
            $data['list_image'] = $this->uploadListImages($request->file('list_image'));
        }
        Product::create($data);
        $notification = array(
            'message' => 'Create product successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.products.index')->with($notification);
    }

    private function uploadImage($file)
    {
        $fileName = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('uploads/products'), $fileName);
        return $fileName;
    }

    private function uploadListImages($files)
    {
        $listImage = [];

        foreach ($files as $file) {
            if ($file->isValid()) {
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $fileName);
                $listImage[] = $fileName;
            }
        }

        return json_encode($listImage);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

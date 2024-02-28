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
    public $limit = 15;
    public function __construct()
    {
        $this->products = new Product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Products";
//        $products = $this->products->paginate(2)->withQueryString();
        $products = Product::with('sizes','colors','variants')->paginate($this->limit)->withQueryString();
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
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $sku = '#'.date('His').rand(100, 999);
        $this->products->sku = $sku;
        $this->products->name = $request->name;
        $this->products->category_id = $request->category_id;
        $this->products->product_type = $request->product_type;
        $this->products->discount_percent = $request->discount_percent;
        $this->products->time_sale = $request->time_sale;
        $this->products->description = $request->description;
        $this->products->price = preg_replace("/[^0-9]/", "", $request->price);
        $this->products->quantity = $request->quantity;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $file_name);
            $this->products->image = $file_name;
        }
        $list_image = [];
        if ($request->hasFile('list_image')) {
            foreach ($request->list_image as $item) {
                if ($item->isValid()) {
                    $item_file_name = date('YmdHi').$item->getClientOriginalName();
                    $item->move(public_path('uploads/products'), $item_file_name);
                    $list_image[] = $item_file_name;
                }
            }
            $json = json_encode($list_image);
            $this->products->list_image = $json;
        }
        $this->products->save();
        $notification = array(
            'message' => 'Create product successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.products.index')->with($notification);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalInfo;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Branch;
use App\Services\FilesService;

class ProductController extends Controller
{
    protected $fileService;
    const LIMIT = 15;
    public function __construct(FilesService $filesService)
    {
        $this->fileService = $filesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Products";
        $products = Product::with('sizes', 'colors', 'variants', 'categories')->paginate(self::LIMIT)->withQueryString();
        return view('admin.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Product";
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $branchs = Branch::all();
        return view('admin.products.create', compact('title', 'categories', 'colors', 'branchs', 'sizes'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $data['sku'] = '#' . date('His') . rand(100, 999);
        $data['price'] = preg_replace("/[^0-9]/", "", $data['price']);
        if ($request->hasFile('image_before')) {
            $data['image_before'] = $this->fileService->uploadImage($request->file('image_before'));
        }

        if ($request->hasFile('image_after')) {
            $data['image_after'] = $this->fileService->uploadImage($request->file('image_after'));
        }

        if ($request->hasFile('list_image')) {
            $data['list_image'] = $this->fileService->uploadListImages($request->file('list_image'));
        }
        $product = Product::create($data);

        $product_id = $product->id;

        //product info
        if ($request->has('additional_infos')) {
            $additional_info_key = json_encode($request->additional_infos['key']);
            $additional_info_value = json_encode($request->additional_infos['value']);
            $product_additional_infos = [
                'product_id' => $product_id,
                'key' => $additional_info_key,
                'value' => $additional_info_value,
            ];
            AdditionalInfo::create($product_additional_infos);
        }

        //product details
        if ($request->has('product_variants')) {
            $product_detail = [];
            $product_detail['product_id'] = $product_id;
            if (isset($request->product_variants['color_id'])) {
                $product_detail['color_id'] = json_encode($request->product_variants['color_id']);
                ProductColor::create(['product_id' => $product_id, 'color_id' => $product_detail['color_id']]);
            }
            if (isset($request->product_variants['size_id'])) {
                $product_detail['size_id'] = json_encode($request->product_variants['size_id']);
                ProductSize::create(['product_id' => $product_id, 'size_id' => $product_detail['size_id']]);
            }
            $product_detail['quantity'] = json_encode($request->product_variants['quantity']);
            $product_detail['price'] = json_encode(preg_replace("/[^0-9]/", "", $request->product_variants['price']));
            if ($request->hasFile('product_variants.image')) {
                $product_detail['image'] = $this->fileService->uploadListImages($request->file('product_variants.image'));
            }

            if (!empty($product_detail)) {
                ProductVariant::create($product_detail);
            }
        }

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
        $title = "Edit Product";
        $product = Product::find($id);
        $product_info = AdditionalInfo::where('product_id', $id)->get();
        $product_variant = ProductVariant::where('product_id', $id)->get();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $branchs = Branch::all();
        return view('admin.products.edit', compact('title', 'categories', 'branchs', 'colors', 'sizes', 'product', 'product_info', 'product_variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        // dd($data);
        //product
        $product = Product::find($id);
        $product->category_id = $data['category_id'];
        $product->branch_id = $data['branch_id'];
        $product->name = $data['name'];
        $product->product_type = $data['product_type'];
        $product->discount_percent = $data['discount_percent'] ?? 0;
        $product->time_sale = $data['time_sale'] ?? null;
        $product->description = $data['description'];
        $product->updated_at = date('Y-m-d H:i:s');
        $product->price = preg_replace("/[^0-9]/", "", $data['price']);
        if ($request->hasFile('image_before')) {
            $this->fileService->deleteImage($product->image_before);
            $product->image_before = $this->fileService->uploadImage($request->file('image_before'));
        }
        if ($request->hasFile('image_after')) {
            $this->fileService->deleteImage($product->image_after);
            $product->image_after = $this->fileService->uploadImage($request->file('image_after'));
        }
        // check remove image detail product not upload image
        if (isset($data['index_list_image']) && !$request->hasFile('list_image')) {
            $index_list_image = $data['index_list_image'];
            $list_image_product = json_decode($product->list_image);
            foreach ($index_list_image as $index) {
                $this->fileService->deleteImage($list_image_product[$index]);
                array_splice($list_image_product, $index, 1);
            }
            $product->list_image = json_encode($list_image_product);
        }
        // check add image or update image and remove image
        if ($request->hasFile('list_image')) {
            $upload_list_image = json_decode($this->fileService->uploadListImages($request->file('list_image')));
            $list_image_db = json_decode($product->list_image);
            if (isset($data['index_list_image'])) {
                $index_list_image = $data['index_list_image'];
                $array_list_image = [];
                foreach ($index_list_image as $index) {
                    if (!empty($upload_list_image[0])) {
                        $this->fileService->deleteImage($list_image_db[$index]);
                        $list_image_db[$index] = $upload_list_image[0];
                        array_splice($upload_list_image, 0, 1);
                    }
                }
                $array_list_image = array_merge($list_image_db, $upload_list_image);
            } else {
                $array_list_image = array_merge($list_image_db, $upload_list_image);
            }
            $product->list_image = json_encode($array_list_image);
        }

        //product info
        if (isset($data['additional_infos'])) {
            $additional_infos = AdditionalInfo::where('product_id', '=', $id)->firstOrFail();
            if ($additional_infos) {
                $additional_infos->key = json_encode($data['additional_infos']['key']);
                $additional_infos->value = json_encode($data['additional_infos']['value']);
                $additional_infos->updated_at = date('Y-m-d H:i:s');
                $additional_infos->save();
            }
        }
        //product variant
        $product->save();
        if (isset($data['product_variants'])) {
            $product_variants = ProductVariant::where('product_id', '=', $id)->firstOrFail();
            if ($product_variants) {
                //update product color
                $product_variants->color_id = json_encode($data['product_variants']['color_id']);
                $product_color = ProductColor::where('product_id', '=', $id)->firstOrFail();
                if ($product_color) {
                    $product_color->color_id = $product_variants->color_id;
                    $product_color->save();
                }

                //update product size
                $product_variants->size_id = json_encode($data['product_variants']['size_id']);
                $product_size = ProductSize::where('product_id', '=', $id)->firstOrFail();
                if ($product_size) {
                    $product_size->size_id = $product_variants->size_id;
                    $product_size->save();
                }

                $product_variants->price = json_encode(preg_replace("/[^0-9]/", "", $data['product_variants']['price']));
                $product_variants->quantity = json_encode($data['product_variants']['quantity']);
                $product_variant_image = [];
                //check remove image variant
                if (isset($data['index_image_variant']) && !$request->hasFile('product_variants.image')) {
                    $product_variant_image = json_decode($product_variants->image);
                    foreach ($data['index_image_variant'] as $index) {
                        $this->fileService->deleteImage($product_variant_image[$index]);
                        array_splice($product_variant_image, $index, 1);
                    }
                    $product_variants->image = json_encode($product_variant_image);
                }

                if ($request->hasFile('product_variants.image')) {
                    $product_list_image_variants = json_decode($this->fileService->uploadListImages($request->file('product_variants.image')));
                    $count_image_variant_rq = count($product_list_image_variants);
                    $count_image_variant_db = json_decode($product_variants->image);

                    if (count($data['product_variants']['size_id']) == (count($count_image_variant_db) + $count_image_variant_rq)) {
                        $this->fileService->deleteImages($product_variants->image);
                        $product_variant_image = $product_list_image_variants;
                        $product_variants->image = json_encode($product_variant_image);
                    } else {
                        $array_list_image_variant = [];
                        if (isset($data['index_image_variant'])) {
                            $index_image_variant = $data['index_image_variant'];
                            foreach ($index_image_variant as $key => $index) {
                                if (!empty($product_list_image_variants[0])) {
                                    $this->fileService->deleteImage($count_image_variant_db[$index]);
                                    $count_image_variant_db[$index] = $product_list_image_variants[0];
                                    array_splice($product_list_image_variants, 0, 1);
                                }
                            }
                            $array_list_image_variant = array_merge($count_image_variant_db, $product_list_image_variants);
                        } else {
                            $array_list_image_variant = array_merge($count_image_variant_db, $product_list_image_variants);
                        }
                        $product_variants->image = json_encode($array_list_image_variant);
                    }
                }
                $product_variants->updated_at = date('Y-m-d H:i:s');
                $product_variants->save();
            }
        }

        $notification = array(
            'message' => 'Create product successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

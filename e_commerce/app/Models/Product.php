<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'category_id', 'image', 'list_image', 'description', 'price', 'quantity', 'product_type', 'discount_percent', 'time_sale', 'is_visible'];

    public function getNameCategoryId($id) {
        return Category::find($id);
    }
    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}

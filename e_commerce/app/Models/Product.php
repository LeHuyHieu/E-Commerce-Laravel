<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'sku', 'category_id', 'image_before', 'image_after', 'list_image', 'description', 'price', 'product_type', 'discount_percent', 'time_sale', 'is_visible'];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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

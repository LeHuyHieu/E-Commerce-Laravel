<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'color_id', 'size_id', 'price', 'quantity', 'image'];

    protected $table = 'product_variants';
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

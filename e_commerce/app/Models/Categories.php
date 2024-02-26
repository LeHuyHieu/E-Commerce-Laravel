<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'slug', 'image', 'status'];

    protected $attributes = [
        'status' => 1,
    ];

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }
}

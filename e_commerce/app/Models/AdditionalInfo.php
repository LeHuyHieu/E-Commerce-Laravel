<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'key', 'value'];
    protected $table = 'additional_infos';
}

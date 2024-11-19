<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
    ];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}

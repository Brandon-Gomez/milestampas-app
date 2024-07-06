<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_image', 'description', 'category_id'];

    protected $with = ['category'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

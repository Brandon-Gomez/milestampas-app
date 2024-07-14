<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'sku',
        'qyt_in_stock',
        'price',
        'image',
        'image2',
        'image3',
    ];

    public function configuration()
    {
        return $this->hasOne(Product_configuration::class, 'product_item_id');
    }
}

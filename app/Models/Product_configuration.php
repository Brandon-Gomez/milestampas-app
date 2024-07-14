<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_configuration extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $guarded = [];

    public function item()
    {
        return $this->belongsTo(Product_item::class, 'product_item_id');
    }
}

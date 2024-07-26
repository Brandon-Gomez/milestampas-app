<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_options extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variation_option()
    {
        return $this->belongsTo(Variation_option::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}

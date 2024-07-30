<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_option extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    public function product_option()
    {
        return $this->hasMany(Product_option::class);
    }
}

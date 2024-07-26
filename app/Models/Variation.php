<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['variationOptions'];

    public function variationOptions()
    {
        return $this->hasMany(Variation_option::class);
    }

    public function productOptions()
    {
        return $this->hasMany(Product_options::class);
    }
}

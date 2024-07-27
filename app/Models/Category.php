<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Cargar automáticamente la categoría padre
    protected $with = ['parent_category'];

    // Permitir la asignación masiva en todos los campos
    protected $guarded = [];

    // Definir la relación con la categoría padre
    public function parent_category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Definir la relación con las categorías hijas
    public function child_categories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource; // Add this line
use App\Http\Resources\ProductResource; // Add this line
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::paginate(10));

        return inertia('Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {

        $categories = CategoryResource::collection(Category::all());

        return inertia('Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.Index');
    }
}

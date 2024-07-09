<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category; // Add this line
use App\Models\Product; // Add this line
use App\Models\Variation;

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
        $variations = Variation::all();

        return inertia('Products/Create', [
            'categories' => $categories,
            'variations' => $variations,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.Index');
    }
}

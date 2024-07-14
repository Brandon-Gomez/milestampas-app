<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
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

        $product = Product::create(
            $request->validate([
                'name' => ['required', 'max:255'],
                'description' => ['required', 'string'],
                'price' => ['required', 'numeric'],
                'qyt_in_stock' => ['required', 'numeric'],
                'category_id' => ['required', 'exists:categories,id'],
                'file' => ['required'],
            ])
        );

        $image = explode('/', $request->file('file')->store('public/products'));
        $product->items()->create([
            'sku' => $product->id.'-'.$product->name,
            'qyt_in_stock' => $request->qyt_in_stock,
            'image' => $image[2],
            'price' => $request->price,
        ]);

        if ($request->variations) {

            foreach ($request->variations as $variation) {

                if (! $variation['variation'] || ! $variation['options'] || ! $variation['price'] || ! $variation['qyt_in_stock']) {
                    continue;
                }

                if (! empty($variation['file'])) {
                    $variation['file']->store('public/products');
                    $varImage = explode('/', $variation['file']->store('public/products'));
                }

                foreach ($variation['options'] as $optionId) {

                    $productItem = $product->items()->create([
                        'sku' => $product->id.'-'.$product->name,
                        'qyt_in_stock' => $variation['qyt_in_stock'],
                        'image' => $varImage[2] ?? null,
                        'price' => $variation['price'],
                    ]);

                    $productItem->configuration()->create([
                        'variation_option_id' => $optionId,
                        'qyt_in_stock' => $variation['qyt_in_stock'],
                        'price' => $variation['price'],
                    ]);
                }

            }
        }

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.Index');
    }
}

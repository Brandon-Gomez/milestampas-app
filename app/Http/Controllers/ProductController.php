<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Response;

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

    public function edit($productId)
    {
        $categories = CategoryResource::collection(Category::all());
        $variations = Variation::all();
        $product = Product::find($productId);

        return inertia('Products/Edit', [
            'product' => ProductResource::make($product),
            'categories' => $categories,
            'variations' => $variations,
        ]);
    }

    public function store(StoreProductRequest $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'short_desc' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'unlimited' => ['required'],
            'image' => ['required', 'image'],
        ]);

        $imagePath = $request->file('image')->store('public/products');
        $imageName = basename($imagePath); // Obtiene solo el nombre del archivo
        $validatedData['image'] = $imageName;

        if ($request->hasFile('image2')) {
            $imagePath = $request->file('image2')->store('public/products');
            $imageName = basename($imagePath); // Obtiene solo el nombre del archivo
            $validatedData['image2'] = $imageName;
        }

        $product = Product::create($validatedData);

        if ($request->variations) {

            foreach ($request->variations as $variation) {

                $validator = Validator::make($variation, [
                    'options' => ['required'],
                    'variation_price' => ['required', 'numeric'],
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }

                foreach ($variation['options'] as $optionId) {

                    $product->options()->create([
                        'product_id' => $product['id'],
                        'variation_id' => $variation['variation'],
                        'variation_option_id' => $optionId,
                        'price_increment' => $variation['variation_price'],
                    ]);

                }

            }
        }

        return redirect()->route('products.index');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists('products/'.$product->image)) {
                Storage::disk('public')->delete('products/'.$product->image);
            }
            $imagePath = $request->file('file')->store('public/products');
            $product->image = basename($imagePath);
        }
        if ($request->hasFile('file2')) {

            if (Storage::disk('public')->exists('products/'.$product->image2)) {
                Storage::disk('public')->delete('products/'.$product->image2);
            }
            $imagePath = $request->file('file2')->store('public/products');
            $product->image2 = basename($imagePath);
        }
        $product->update([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'unlimited' => $request->unlimited,
        ]);

        // if variations are sent
        if ($request->variations) {

            // delete all variations
            $product->options()->delete();

            // create new variations
            foreach ($request->variations as $variation) {

                $validator = Validator::make($variation, [
                    'options' => ['required'],
                    'variation_price' => ['required', 'numeric'],
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }

                foreach ($variation['options'] as $optionId) {

                    $product->options()->create([
                        'product_id' => $product['id'],
                        'variation_id' => $variation['variation'],
                        'variation_option_id' => $optionId,
                        'price_increment' => $variation['variation_price'],
                    ]);

                }

            }
        }

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        if (Storage::disk('public')->exists('products/'.$product->image)) {
            Storage::disk('public')->delete('products/'.$product->image);
        }
        if (Storage::disk('public')->exists('products/'.$product->image2)) {
            Storage::disk('public')->delete('products/'.$product->image2);
        }
        if (Storage::disk('public')->exists('products/'.$product->image3)) {
            Storage::disk('public')->delete('products/'.$product->image3);
        }
        $product->delete();
    }

    public function show($productId): Response
    {
        // name url as show

        

        $product = Product::find($productId);

        return inertia('Products/Show', [
            'product' => ProductResource::make($product),
        ]);
    }

    public function getProductsNewIn2024()
    {
        $products = Product::whereYear('created_at', 2024)->get();

        return response()->json($products);
    }
}

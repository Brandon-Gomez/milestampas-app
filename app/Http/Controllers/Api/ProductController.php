<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListProductsRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(ListProductsRequest $request)
    {
        // $Products = Product::where('product_id', $request->product_id)->get();

        // return ProductResource::collection($Products);
    }


}

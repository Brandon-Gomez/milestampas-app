<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListVariationsRequest;
use App\Models\Variation;

class VariationController extends Controller
{
    public function __invoke(ListVariationsRequest $request)
    {
        $variation = Variation::where('category_id', $request->category_id)->get();

        return VariationResource::collection($variation);
    }
}

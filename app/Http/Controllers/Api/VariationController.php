<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListVariationsRequest;
use App\Http\Resources\VariationResource;
use App\Models\Variation;

class VariationController extends Controller
{
    public function __invoke(ListVariationsRequest $request)
    {
        $variations = Variation::where('product_id', $request->product_id)->get();

        return VariationResource::collection($variations);
    }
}

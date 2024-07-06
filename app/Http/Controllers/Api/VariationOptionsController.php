<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListVariationOptionsRequest;
use App\Http\Resources\VariationOptionResource;
use App\Models\Variation_option;

class VariationOptionsController extends Controller
{
    public function __invoke(ListVariationOptionsRequest $request)
    {
        $variationOptions = Variation_option::where('variation_id', $request->variation_id)->get();

        return VariationOptionResource::collection($variationOptions);
    }
}

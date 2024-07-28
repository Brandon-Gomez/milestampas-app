<?php

namespace App\Http\Controllers;

use App\Http\Resources\VariationOptionResource;
use App\Http\Resources\VariationResource;
use App\Models\Variation;
use App\Models\Variation_option;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class VariationOptionController extends Controller
{
    /**
     * Display the variation_options list.
     */
    public function index(Request $request): Response
    {
        $variationOptions = VariationOptionResource::collection(Variation_option::paginate(10));

        return inertia('Variation_options/Index', [
            'variationOptions' => $variationOptions,
        ]);
    }

    /**
     * Display the create variation_options form.
     */
    public function create(Request $request): Response
    {
        $variations = VariationResource::collection(Variation::all());

        return inertia('Variation_options/Create', [
            'variations' => $variations,
        ]);
    }

    /**
     * Display the variation edit form.
     */
    public function edit(Request $request, Variation_option $variation_option): Response
    {
        dd('test');

        return inertia('VariationOptions/Edit', [
            'variation_option' => $variation_option,
        ]);
    }

    /**
     * Update the variation information.
     */
    public function update(Request $request, Variation_option $variation): RedirectResponse
    {
        $variation->update($request->all());

        return Redirect::route('variation_options.index');

    }

    /**
     * Delete the variation .
     */
    public function destroy(Variation_option $variationOption)
    {
        $variationOption->delete();

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'variations' => ['required'],
        ]);

        foreach ($request->variations as $variation) {
            $variationOption = Variation_option::where('variation_id', $variation)->where('name', $request->name)->first();
            if ($variationOption) {
                return Redirect::back()->withErrors(['name' => 'Option name already exists for variation: '.$variationOption->variation->name]);
            }
        }

        foreach ($request->variations as $variation) {
            Variation_option::create([
                'name' => $request->name,
                'variation_id' => $variation,
            ]);
        }
    }
}

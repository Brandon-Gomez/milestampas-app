<?php

namespace App\Http\Controllers;

use App\Http\Resources\VariationResource;
use App\Models\Variation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class VariationController extends Controller
{
    /**
     * Display the variations list.
     */
    public function index(Request $request): Response
    {
        $variations = VariationResource::collection(Variation::paginate(10));

        return inertia('Variations/Index', [
            'variations' => $variations,
        ]);
    }

    /**
     * Display the create variations form.
     */
    public function create(Request $request): Response
    {
        $variations = VariationResource::collection(Variation::all());

        return inertia('Variations/Create', [
            'variations' => $variations,
        ]);
    }

    /**
     * Display the variation edit form.
     */
    public function edit(Request $request, Variation $variation): Response
    {
        return inertia('Variations/Edit', [
            'variation' => $variation,
        ]);
    }

    /**
     * Update the variation information.
     */
    public function update(Request $request, Variation $variation): RedirectResponse
    {
        $variation->update($request->all());

        return Redirect::route('variations.index');

    }

    /**
     * Delete the variation .
     */
    public function destroy(Request $request, Variation $variation): RedirectResponse
    {

        $variation->delete();

        return Redirect::route('variations.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable'],
        ]);
        Variation::create($request->all());

        return Redirect::route('variations.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display the categories list.
     */
    public function index(): Response
    {
        $categories = CategoryResource::collection(Category::paginate(10));

        return inertia('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the create categories form.
     */
    public function create(): Response
    {
        $categories = CategoryResource::collection(Category::all());

        return inertia('Categories/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the category edit form.
     */
    public function edit(Category $category): Response
    {

        $categories = CategoryResource::collection(Category::where('id', '!=', $category->id)->get());

        return inertia('Categories/Edit', [
            'category' => $category,
            'categories' => $categories,
        ]);

    }

    /**
     * Update the category information.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $parentCategory = Category::find($request->parent_category_id);

        if ($parentCategory->parent_category_id == $category->id) {
            return Redirect::back()->withErrors(['parent_category_id' => 'The parent category is already related']);
        }

        $category->update([
            'name' => $request->name,
            'parent_category_id' => $request->parent_category_id, ]
        );

        return Redirect::route('categories.index');

    }

    /**
     * Delete the category .
     */
    public function destroy(Category $category): RedirectResponse
    {

        $category->delete();

        return Redirect::route('categories.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);
        Category::create($request->all());

        return Redirect::route('categories.index');
    }
}

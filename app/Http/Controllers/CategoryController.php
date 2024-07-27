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
    public function index(Request $request): Response
    {
        $categories = CategoryResource::collection(Category::paginate(10));

        return inertia('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the create categories form.
     */
    public function create(Request $request): Response
    {
        $categories = CategoryResource::collection(Category::all());

        return inertia('Categories/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the category edit form.
     */
    public function edit(Request $request, Category $category): Response
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
        // data table
        // 2 4 Bundesligue 2024-07-26 00:00:00 2024-07-26 23:31:48
        // 4 2 Premier League 2024-07-26 23:07:20 2024-07-27 00:39:19

        // validar para evitar el bucle 2 4 y 4 2

        // check if parent id is the same as the category id

        // get category by parent id

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
    public function destroy(Request $request, Category $category): RedirectResponse
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

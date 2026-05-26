<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' =>
            'required|max:50|unique:categories,nombre',

            'descripcion' =>
            'nullable|max:150'
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Categoría creada correctamente'
            );
    }

    public function edit(Category $category)
    {
        return view(
            'categories.edit',
            compact('category')
        );
    }

    public function update(
        Request $request,
        Category $category
    ) {

        $validated = $request->validate([

            'nombre' =>
            'required|max:50|unique:categories,nombre,' . $category->id,

            'descripcion' =>
            'nullable|max:150'
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Categoría actualizada correctamente'
            );
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Categoría eliminada correctamente'
            );
    }
}

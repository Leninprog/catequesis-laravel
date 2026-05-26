<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with(
            'category'
        )->get();

        return view(
            'subcategories.index',
            compact('subcategories')
        );
    }

    public function create()
    {
        $categories = Category::orderBy(
            'nombre'
        )->get();

        return view(
            'subcategories.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'category_id' =>
            'required|exists:categories,id',

            'nombre' =>
            'required|max:60',

            'descripcion' =>
            'nullable|max:150'
        ]);

        Subcategory::create($validated);

        return redirect()
            ->route('subcategories.index')
            ->with(
                'success',
                'Subcategoría creada correctamente'
            );
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy(
            'nombre'
        )->get();

        return view(
            'subcategories.edit',
            compact(
                'subcategory',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Subcategory $subcategory
    ) {

        $validated = $request->validate([

            'category_id' =>
            'required|exists:categories,id',

            'nombre' =>
            'required|max:60',

            'descripcion' =>
            'nullable|max:150'
        ]);

        $subcategory->update($validated);

        return redirect()
            ->route('subcategories.index')
            ->with(
                'success',
                'Subcategoría actualizada correctamente'
            );
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()
            ->route('subcategories.index')
            ->with(
                'success',
                'Subcategoría eliminada correctamente'
            );
    }
}

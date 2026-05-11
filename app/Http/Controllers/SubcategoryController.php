<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();

        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | CARGAR CATEGORÍAS PARA EL DROPDOWN
        |--------------------------------------------------------------------------
        */

        $categories = Category::all();

        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|max:60',
            'descripcion' => 'nullable|max:150'
        ]);

        Subcategory::create($validated);

        return redirect()
            ->route('subcategories.index')
            ->with('success', 'Subcategoría creada correctamente');
    }
}

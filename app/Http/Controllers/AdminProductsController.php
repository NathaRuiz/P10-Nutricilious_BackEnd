<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($product);
    }

    public function productsByCategory($id_category)
    {
        $products = Product::where('id_category', $id_category)->get();

        return response()->json($products);
    }

    public function showCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function showCompanies()
    {
        $companies = User::where('rol_id', 3)->get();
        return response()->json(['companies' => $companies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
            'id_category' => 'required|exists:categories,id',
        ]);


        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
            'id_category' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return response()->json(['message' => 'Producto actualizado correctamente'], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}

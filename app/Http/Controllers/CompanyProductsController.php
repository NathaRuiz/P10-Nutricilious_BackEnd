<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class CompanyProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
         $user = $request->user();
         $products = $user->products;
 
         return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
            'id_category' => 'required|exists:categories,id',
        ]);
    
        $product = new Product($request->all());
        $product->id_userCompany = $user->id;
        $product->save();
    
        return response()->json($product, 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $product = Product::where('id', $id)->where('id_userCompany', $user->id)->first();

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado o no autorizado'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

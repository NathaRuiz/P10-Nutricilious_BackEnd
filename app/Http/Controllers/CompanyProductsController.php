<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = $request->user();
        // $products = $user->products;
        // //traer productos y al producto le debemos decir que traiga el id del usuario company solicitado
        // return response()->json($products);

         // Obtén el usuario autenticado
         $user = $request->user();

         // Obtén todos los productos asociados a este usuario
         $products = $user->products;
 
         return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

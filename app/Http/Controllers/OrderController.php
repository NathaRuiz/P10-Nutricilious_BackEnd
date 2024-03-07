<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_Order;

class OrderController extends Controller
{
    public function addToCart(Request $request)
{
    $user = auth()->user();

    // Buscar un carrito activo para el usuario
    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    // Si no hay un carrito activo, crea uno nuevo
    if (!$cart) {
        $cart = Order::create([
            'user_id' => $user->id,
            'status' => 'Processing',
            'unit_quantity' => 0,
            'total_price' => 0,
        ]);
    }

    // Obtener información del producto
    $product = Product::find($request->input('id_product'));

    // Verificar si el producto existe
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Añadir el producto al carrito
    $cartItem = Product_Order::create([
        'order_id' => $cart->id,
        'id_product' => $request->input('id_product'),
        'product_quantity' => $request->input('product_quantity'),
        'total_price' => $request->input('product_quantity') * $product->price,
    ]);

    // Actualizar la cantidad y el precio total del carrito
    $cart->update([
        'unit_quantity' => $cart->unit_quantity + 1,
        'total_price' => $cart->total_price + $cartItem->total_price,
    ]);

    return response()->json(['message' => 'Producto añadido al carrito satisfactoriamente']);
}


public function viewCart()
{
    // Obtén el usuario autenticado
    $user = auth()->user();

    // Busca un carrito activo para el usuario
    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if ($cart) {
        // Recupera los productos en el carrito con sus nombres
        $productNames = Product_Order::where('order_id', $cart->id)
            ->with(['product:id,name'])
            ->get(['id_product', 'product_quantity']);

        // Transforma la colección para mostrar solo el campo "name"
        $productNames->transform(function ($item) {
            return [
                'id_product' => $item->id_product,
                'product_quantity' => $item->product_quantity,
                'product' => $item->product->name,
            ];
        });

        return response()->json(['order' => $cart, 'productNames' => $productNames]);
    }

    return response()->json(['message' => 'Carrito está vacío']);
}




public function updateCart(Request $request)
{
    $user = auth()->user();

    // Buscar un carrito activo para el usuario
    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    // Si no hay un carrito activo, puedes manejar esto según tus requisitos (crear uno nuevo o devolver un mensaje)
    if (!$cart) {
        return response()->json(['message' => 'Cart not found'], 404);
    }

    // Verificar si los datos necesarios están presentes en la solicitud
    if ($request->has('id_product') && $request->has('product_quantity')) {
        // Obtener el precio del producto
        $productPrice = Product::find($request->input('id_product'))->price;

        // Actualizar el carrito usando la relación product_order
        $cart->product_order()->where('id_product', $request->input('id_product'))->update([
            'product_quantity' => $request->input('product_quantity'),
            'total_price' => $productPrice * $request->input('product_quantity'),
        ]);

        // Recalcula el total_price basado en la nueva unit_quantity
        $cart->update([
            'total_price' => $cart->product_order()->sum('total_price'),
        ]);

        return response()->json(['message' => 'Cart updated successfully']);
    } else {
        return response()->json(['error' => 'Missing data for cart update'], 400);
    }
}


}




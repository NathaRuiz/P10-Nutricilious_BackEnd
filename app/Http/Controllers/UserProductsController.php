<?php
namespace App\Http\Controllers;

require_once base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;



class UserProductsController extends Controller
{
    public function addToCart(Request $request)
{
    $user = auth()->user();

    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if (!$cart) {
        $cart = Order::create([
            'user_id' => $user->id,
            'status' => 'Processing',
            'unit_quantity' => 0,
            'total_price' => 0,
        ]);
    }

    $product = Product::find($request->input('id_product'));

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    $cartItem = Product_Order::create([
        'order_id' => $cart->id,
        'id_product' => $request->input('id_product'),
        'product_quantity' => $request->input('product_quantity'),
        'total_price' => $request->input('product_quantity') * $product->price,
    ]);

    $cart->update([
        'unit_quantity' => $cart->unit_quantity + 1,
        'total_price' => $cart->total_price + $cartItem->total_price,
    ]);

    return response()->json(['message' => 'Producto añadido al carrito satisfactoriamente']);
}


public function viewCart()
{
    $user = auth()->user();

    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if ($cart) {
        $productNames = Product_Order::where('order_id', $cart->id)
            ->with(['product:id,name'])
            ->get(['id_product', 'product_quantity']);

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

    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if (!$cart) {
        return response()->json(['message' => 'Cart not found'], 404);
    }

    if ($request->has('id_product') && $request->has('product_quantity')) {
        $productPrice = Product::find($request->input('id_product'))->price;

        $cart->product_order()->where('id_product', $request->input('id_product'))->update([
            'product_quantity' => $request->input('product_quantity'),
            'total_price' => $productPrice * $request->input('product_quantity'),
        ]);

        $cart->update([
            'total_price' => $cart->product_order()->sum('total_price'),
        ]);

        return response()->json(['message' => 'El carrito se ha actualizado con éxito']);
    } else {
        return response()->json(['error' => 'No se encuentran datos en el carrito'], 400);
    }
}

public function clearCart()
{
    $user = auth()->user();

    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if ($cart) {
        $cart->product_order()->delete();

        $cart->update([
            'unit_quantity' => 0,
            'total_price' => 0,
        ]);

        return response()->json(['message' => 'El carrito se ha limpiado satisfactoriamente']);
    }

    return response()->json(['message' => 'El carrito está vacio']);
}

public function removeProductFromCart(Request $request)
{
    $user = auth()->user();

    $cart = Order::where('user_id', $user->id)->where('status', 'Processing')->first();

    if (!$cart) {
        return response()->json(['message' => 'No se encuentra el carrito'], 404);
    }

    $id_product = $request->input('id_product');

    $deleted = DB::table('products_order')
        ->where('order_id', $cart->id)
        ->where('id_product', $id_product)
        ->delete();

    if ($deleted) {
        $cart->update([
            'unit_quantity' => $cart->product_order()->sum('product_quantity'),
            'total_price' => $cart->product_order()->sum('total_price'),
        ]);

        return response()->json(['message' => 'El producto se ha eliminado del carrito con éxito']);
    } else {
        return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
    }
}

public function purchase()
{
    $user = auth()->user();

    $twilioAccountSid = env('TWILIO_ACCOUNT_SID');
    $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
    $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
    $twilioUserPhoneNumber = env('TWILIO_USER_PHONE_NUMBER');
    
    $twilio = new Client($twilioAccountSid, $twilioAuthToken);

    $message = $twilio->messages
      ->create("whatsapp:".$twilioUserPhoneNumber,
        array(
          "from" => "whatsapp:".$twilioPhoneNumber,
          "body" => $user->name." ¡Gracias por tu compra en Nutrilicious! Tu pedido se ha procesado con éxito."
        )
      );

print($message->sid);
}
}





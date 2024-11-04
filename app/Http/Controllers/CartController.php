<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\SalesController;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart');

        return view('Menus.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {

        $product = inventario::find($request->id);

        if (!$product) {
            Alert::error('Error', 'El producto no existe! Verifique los datos');
            return redirect()->back();
        }

        $cart = session()->get('cart', []);

        // Revisa si se encuentra en el carrito y aumenta 1
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->cantidad;
        } else {
            // Si no se encuentra agrega uno inicialmente
            $cart[$request->id] = [
                "name" => $product->nombre,
                "quantity" => $request->cantidad,
                "price" => $product->precio
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function removeFromCart($id)
    {


        // Obtén el carrito de la sesión
        $cart = session()->get('cart');

        // Verifica que el producto existe en el carrito
        if (isset($cart[$id])) {
            // Elimina el producto del carrito
            unset($cart[$id]);

            // Actualiza el carrito en la sesión
            session()->put('cart', $cart);
        }

        // Redirige de regreso al carrito con un mensaje
        return redirect()->back();
    }

    public function closeCart()
    {
        //se obtione el contenido de cart
        $cart = session()->get('cart');

        if (!$cart) {
            Alert::error('Error', 'El carrito esta vacio');
            return redirect()->back();
        }

        //por cada id(Id de producto)-data(contenido del producto ej name stock etc)
        foreach ($cart as $id => $data) {
            $quantity = $data['quantity'];

            //decrementa de stock el contenido de carrito
            inventario::where('id', $id)->decrement('stock', $quantity);
        }

        //limpia el carrito de la sesion

        $salesController = new SalesController();
        $salesController->savesale();
        session()->forget('cart');
        return view('Menus.index');
    }
}

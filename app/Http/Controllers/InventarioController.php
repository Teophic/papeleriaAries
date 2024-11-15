<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;
use RealRashid\SweetAlert\Facades\Alert;

class InventarioController extends Controller
{
    /**
     * index mostrar todos los datos
     * store guardar datos
     * update actualizar datos
     * destroy eliminar todo
     * edit para mostrar el formulario de edicion
     */

    public function index()
    {
        return view('Menus.agregar');
    }

    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required|unique:inventarios,id',
            'nombre' => 'required|max:50',
            'marca' => 'required|max:50',
            'precio' => 'required|min:0',
            'stock' => 'required|min:0|',
            'categoria' => 'required|max:100',
        ]);

        $producto = new inventario();

        $producto->id = $request->id;
        $producto->nombre = $request->nombre;
        $producto->marca = $request->marca;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->Categoria = $request->categoria;

        $producto->save();

        return redirect()->route('invSave')->with('success', 'Producto agregado');
    }

    //Funcion de buscar en la vista de Buscar-stock
    public function search(Request $request,)
    {
        $busqueda = $request->get('busqueda');
        if ($busqueda) {
            $resultados = inventario::where('id', '=', $busqueda)
                ->orWhere('nombre', 'LIKE', "%$busqueda%")
                ->orWhere('marca', 'LIKE', "%$busqueda%")
                ->orWhere('stock', '=', $busqueda)
                ->get();
            return view('Menus.stock', compact('resultados'));
        }
        return view('Menus.stock');
    }

    public function noStock()
    {

        $resultados = inventario::Where('stock', '=', 0)
            ->get();
        return view('Menus.stock', compact('resultados'));
    }



    public function show($id)
    {
        $producto = inventario::find($id);

        return view('Menus.show', ['producto' => $producto]);
    }

    public function update(request  $request, $id)
    {
        $producto = inventario::find($id);
        $producto->id = $request->id;
        $producto->nombre = $request->nombre;
        $producto->marca = $request->marca;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->Categoria = $request->categoria;

        $producto->save();


        return view('Menus.stock')->with('success', 'Producto modificado');
    }

    public function destroy($id)
    {




        $producto = inventario::find($id);
        $producto->delete();



        return view('Menus.stock')->with('success', 'Producto eliminado');
    }

    //Agregar al carrito desde la busqueda de stock.

    public function addToCart(Request $request)
    {
        $data = $request->all();


        $product = inventario::find(array_key_last($data));

        $cart = session()->get('cart', []);

        // Revisa si se encuentra en el carrito y aumenta 1
        if (isset($cart[array_key_last($data)])) {
            $cart[array_key_last($data)]['quantity']++;
        } else {
            // Si no se encuentra agrega uno inicialmente
            $cart[array_key_last($data)] = [
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio
            ];
        }
        session()->put('cart', $cart);
        Alert::success('Producto agregado', '');
        return redirect()->back();
    }
}

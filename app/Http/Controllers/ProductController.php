<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\inventario;
use App\Models\TemporaryTable;
//use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    public function showProducts()
    {
        $productos = TemporaryTable::all();


        return view('Menus.index', compact('productos'));
    }

    public function addProduct(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'cantidad' => 'required',
        ]);

        $producto = new TemporaryTable();

        $data = inventario::find($request->id);

        if (!$data) {
            Alert::error('Error', 'El producto no existe! Verifique los datos');
            return redirect()->route('productos');
        }
        $producto->id = $request->id;
        $producto->precio = $data->precio;
        $producto->nombre = $data->nombre;
        $producto->cantidad = $request->cantidad;

        $producto->save();

        $productos = TemporaryTable::all();

        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto->precio * $producto->cantidad;
        }

        $total = $subtotal;
        return redirect()->route('productos')->with('total', $total);
    }


    //Funcion para remover la tabla actual que se usa en la lista de compra
    public function removeStock(Request $request)
    {
        $data = TemporaryTable::all();



        foreach ($data as $key) {
            $cantidad = $key->cantidad;
            inventario::where('id', $key->id)->decrement('stock', $cantidad);
        }

        $subtotal = 0;
        foreach ($data as $producto) {
            $subtotal += $producto->precio * $producto->cantidad;
        }


        $total = $request->pago - $subtotal;

        TemporaryTable::truncate();
        DB::statement('update temporary_tables set n=0');
        Alert::success('Gracias por su compra', 'Su cambio es: ' . $total);



        return redirect()->route('productos');
    }

    //Funcion remover producto de la lista de compra
    public function destroy($id)
    {


        $producto = TemporaryTable::where('n', $id);

        $producto->delete();

        $productos = TemporaryTable::all();

        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto->precio * $producto->cantidad;
        }

        $total = $subtotal;
        return redirect()->route('productos')->with('total', $total);
    }
}

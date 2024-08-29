<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;
use App\Models\TemporaryTable;

class InventarioController extends Controller
{
    /**
     * index mostrar todos los datos
     * store guardar datos
     * update actualizar datos
     * destroy eliminar todo
     * edit para mostrar el formulario de edicion
     */

     public function store(Request $request){

        $request -> validate([
            'id' => 'required|unique:inventarios,id',
            'nombre' => 'required|max:50',
            'marca' => 'required|max:50',
            'precio' => 'required|min:0',
            'stock' => 'required|min:0|',
        ]);

        $producto = new inventario();

        $producto ->id = $request->id;
        $producto ->nombre = $request->nombre;
        $producto ->marca = $request->marca;
        $producto ->precio = $request->precio;
        $producto ->stock = $request->stock;

        $producto->save();

        return redirect()->route('invSave')->with('success', 'Producto agregado');

     }
     //Funcion de buscar en la vista de Buscar-stock
     public function search(Request $request,){
        $busqueda = $request->get('busqueda');
        if($busqueda){
        $resultados = inventario::where('id' ,'=',$busqueda)
        ->orWhere('nombre' ,'LIKE',"%$busqueda%")
        ->orWhere('marca' ,'LIKE',"%$busqueda%")
        ->orWhere('stock' ,'=',$busqueda)
        -> get();
        return view('Menus.stock', compact('resultados'));
         }
        return view('Menus.stock');
     }



     public function show($id){
        $producto = inventario::find($id);

        return view('Menus.show', ['producto' => $producto]);
     }

     public function update(request  $request,$id){
        $producto = inventario::find($id);
        $producto ->id = $request->id;
        $producto ->nombre = $request->nombre;
        $producto ->marca = $request->marca;
        $producto ->precio = $request->precio;
        $producto ->stock = $request->stock;

        $producto->save();


        return view('Menus.stock')->with('success', 'Producto modificado');
     }

     public function destroy($id){
        $producto = inventario::find($id);
        $producto -> delete();



        return view('Menus.stock')->with('success', 'Producto eliminado');
     }

     //Funcion para agregar a la tabla de compras desde el buscador de articulos.

     public function storeTemp(Request $request){
        //obtiene todos los datos del request (token e id)
        $dataK = $request->all();

        // Obtener la primera clave del array de datos 1:token(first) 2:id(last)
        $id = array_key_last($dataK);


        //Se realiza lo mismo que en el controlador ProductController para agregar a la tabla
        $producto = new TemporaryTable();

        $data = inventario::find($id);

        $producto ->id = $id;
        $producto->precio = $data->precio;
        $producto->nombre = $data->nombre;
        $producto ->cantidad = 1;

        $producto->save();

        $productos = TemporaryTable::all();

        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto->precio * $producto->cantidad;
        }

        $total = $subtotal;
        return redirect()->route('productos')->with('total',$total);
     }

}

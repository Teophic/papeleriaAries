<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;

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

     public function search(Request $request,){
        $busqueda = $request->get('busqueda');

        $resultados = inventario::where('id' ,'=',$busqueda)
        ->orWhere('nombre' ,'LIKE',"%$busqueda%")
        ->orWhere('marca' ,'LIKE',"%$busqueda%")
        ->orWhere('stock' ,'=',$busqueda)
        -> get();
       
        return view('Menus.stock', compact('resultados'));
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

}

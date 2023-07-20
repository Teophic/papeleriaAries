<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function addProduct(Request $request){
      
        $request->validate([
            'id' => 'required',
            'cantidad' => 'required',
       ]);

       $producto = new TemporaryTable();

       $data = inventario::find($request->id);

       if(!$data){
        Alert::error('Error', 'El producto no existe! Verifique los datos');
        return redirect()->route('productos');
       }
        $producto ->id = $request->id;
        $producto->precio = $data->precio;
        $producto->nombre = $data->nombre;
        $producto ->cantidad = $request->cantidad;

        $producto->save();
    
        

        
       
        return redirect()->route('productos')->with([
            'success' => 'Producto agregado correctamente.',
        ]);
     }

     public function infoPago(){

        $productos = TemporaryTable::all();

        $subtotal = 0;
        foreach ($productos as $producto) {
            $subtotal += $producto->precio * $producto->cantidad;
        }

        $total = $subtotal;
       
        Alert::info('Total', 'El total a pagar es: '.$total);

        return redirect()->route('productos');
     }

     //Funcion para remover la tabla actual que se usa en la lista de compra
     public function removeStock()
     {
        $data = TemporaryTable::all();

        foreach($data as $key){
            $cantidad = $key->cantidad;
            inventario::where('id', $key->id)->decrement('stock', $cantidad);
            $test = inventario::where('id', $key->id)->get();
            
        }

        TemporaryTable::truncate();
        Alert::success('Gracias por su compra');
        
        

        return redirect()->route('productos');
     }

    //Funcion remover producto de la lista de compra
    public function destroy($id){


        $producto = TemporaryTable::find($id);

        if (!$producto) {
            // El producto no existe, puedes mostrar un mensaje de error o redirigir a otra página
            
            return redirect()->back()->with('error', 'No hay nada que pagar');
        }

        
        $producto -> delete();

        return redirect()->route('productos');
     }
}

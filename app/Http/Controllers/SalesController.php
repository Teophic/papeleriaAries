<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sells;

class SalesController extends Controller
{
    //
    public function savesale()
    {
        $idSale = sells::latest()->value('idVenta');

        if (!$idSale) {
            $idSale = 1;
        } else {

            $idSale++;
        }



        $cart = session()->get('cart');



        foreach ($cart as $id => $data) {

            $sale = new sells();
            $sale->idVenta = $idSale;
            $sale->idProducto = $id;
            $sale->nombreProducto = $data['name'];
            $sale->cantidad = $data['quantity'];
            $sale->precioTotal = $data['quantity'] * $data['price'];

            $sale->save();
        }
    }
}

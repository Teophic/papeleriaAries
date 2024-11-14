@extends('Partials/navbar')

@section('content')

<div class="d-flex falign-self-stretch gap-3 ">
    <div class="p-4 w-25 align-self-center">

        <form action="{{ route('addCart') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">Código</label>
                <input type="number" name="id" id="id" class="form-control" placeholder="123456789" autofocus>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" value="1" class="form-control">
            </div>
            <button type="submit" class="btn button-body-color mb-1">Agregar a compra</button>
        </form>


        <form action="{{ route('closeCart') }}" method="POST" class="mt-1">
            @method("DELETE")
            @csrf
            {{-- <label for="pago" class="form-label mt-3">Pago con: </label>
            <input type="number" name="pago" id="pago" min="0" class="form-control"> --}}
            <button type="submit" class="btn button-body-color mt-2">Pagar</button>
        </form>

    </div>
    <div class="table-responsive p-4 w-75 align-self-center">
        <div class="table-wrapper-scroll-y my-custom-scrollbar" style="position: relative;height:950px;overflow-y: auto;display: block;overflow-x: hidden;">
            <table class="table  table-color  mb-0">
                <thead>
                    <tr class="table-text-color">
                        <th class="th-sm " scope="col">#</th>
                        <th class="th-sm" scope="col">Nombre</th>
                        <th class="th-sm" scope="col">Precio</th>
                        <th class="th-sm" scope="col">Cantidad</th>
                        <th class="th-sm" scope="col">Subtotal</th>
                        <th class="th-sm" scope="col">#</th>
                    </tr>
                </thead>
                @if(session('cart'))
                <ul>
                    @php
                        $total=0;
                        $n=0;
                    @endphp
                    @foreach(session('cart') as $id => $details)
                        @php
                            $subtotal = $details['price'] * $details['quantity'];
                            $n++;
                            $total+=$subtotal;
                         @endphp

                        <tr class="table-text-color">
                            <td>{{ $n }}</td>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['price'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ $subtotal }}</td>
                            <td><a href="{{route('removeCart',$id)}}" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    @endforeach
                </ul>
                <tr class="table-text-color">
                    <td colspan="4">Total</td>
                    <td>{{$total}}</td>
                </tr>
                @else
                <tr class="table-text-color">
                    <td colspan="5">No hay productos para comprar.</td>
                </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

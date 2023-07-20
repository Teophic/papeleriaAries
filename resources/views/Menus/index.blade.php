@extends('Partials/navbar')

@section('content')

<div class="d-flex falign-self-stretch gap-3 ">
    <div class="p-4 w-25 align-self-center">
        <form action="{{ route('addProduct') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">Código</label>
                <input type="number" name="id" id="id" class="form-control" placeholder="123456789">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" value="1" class="form-control">
            </div>
            <button type="submit" class="btn button-body-color">Agregar a compra</button>
        </form>

        <form action="{{ route('infoPago') }}" method="GET" class="mt-3">
            @csrf
            <button type="submit" class="btn button-body-color">Info costo total</button>
        </form>

        <form action="{{ route('removeProduct') }}" method="POST" class="mt-3">
            @method("DELETE")
            @csrf
            
            <!--<label for="total" class="form-label mt-3">Total</label>
                <input type="number" name="total" id="total" value="{{ session('total', 0) }}" disabled class="from-control">-->
            <button type="submit" class="btn button-body-color">Pagar</button>
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
                        <th class="th-sm" scope="col">#</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-text-color">
                    @if(isset($productos) && !$productos->isEmpty())
                        @foreach ($productos as $producto )  
                            <tr class="table-text-color">
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td><form action="{{ route('deleteProduct', [$producto->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn button-color btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No hay productos para comprar.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

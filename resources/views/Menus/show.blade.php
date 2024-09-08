@extends('Partials/navbar')

@section('content')
    <div class="d-flex falign-self-stretch gap-3">
        <div class="p-4 w-100 ms-5 me-5 align-self-center">
            <form action="{{route('edit', ['id' => $producto->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="id" class="form-label">Codigo</label>
                    <input type="number" min="0" name="id" class="form-control" disabled value="{{$producto->id}}">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}">
                </div>
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{$producto->marca}}">
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text"  name="categoria" class="form-control " value="{{$producto->Categoria}}">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" min="0" step=".01" name="precio" class="form-control" value="{{$producto->precio}}">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad</label>
                    <input type="number" min="0" name="stock" class="form-control" value="{{$producto->stock}}">
                </div>
                <button type="submit" class="btn btn-primary ">Actualizar</button>
            </form>
        </div>
    </div>
@endsection

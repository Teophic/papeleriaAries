@extends('Partials/navbar')

@section('content')
    <div class="d-flex falign-self-stretch gap-3 ">
        <div class="p-4 w-25 align-self-center " >
            <form action="{{ route('search') }}" method="GET">
                @csrf

                <div class="mb-3">
                    <label for="id" class="form-label">Busqueda</label>
                    <input type="text" name="busqueda"   class="form-control" autofocus>
                </div><!--
                <select name="campo" class="form-select" aria-label="Default select example">
                    <option selected>Tipo de busqueda</option>
                    <option value="id">Codigo</option>
                    <option value="nombre">Nombre</option>
                    <option value="marca">Marca</option>
                    <option value="stock">Existencias</option>
                </select>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" min="0" value="" step=".01" name="precio" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad</label>
                    <input type="number" min="0" name="stock" class="form-control">
                </div> -->
                <button type="submit" class="btn button-body-color ">Buscar</button>
            </form>
        </div>
        <div class="table-responsive p-4 w-75 align-self-center" >

            <div class="table-wrapper-scroll-y my-custom-scrollbar"  style="position: relative;height:950px;overflow-y: auto;display: block;overflow-x: hidden;">

                    <table class="table table-color mb-0">
                        <div class="row py-1">
                            <div class="col-md-9 d-flex align-items-center">

                                <thead class="table-text-color" >

                                    <th class="th-sm" scope="col">#</th>
                                    <th class="th-sm" scope="col">Nombre</th>
                                    <th class="th-sm" scope="col">Marca</th>
                                    <th class="th-sm" scope="col">Precio</th>
                                    <th class="th-sm" scope="col">Existencias</th>
                                    <th class="th-sm" scope="col">#</th>
                                    <th class="th-sm" scope="col">#</th>
                                    <th class="th-sm" scope="col">#</th>

                                </thead>
                                <tbody class="table-group-divider table-text-color">
                                @if(isset($resultados))


                                @foreach ($resultados as $producto )
                                    <tr class="table-text-color">

                                        <td>{{$producto->id}}</a></td>
                                        <td>{{$producto->nombre}}</td>
                                        <td>{{$producto->marca}}</td>
                                        <td>{{$producto->precio}}</td>
                                        <td>{{$producto->stock}}</td>
                                        <td>
                                            <form action="{{ route('saveT', [$producto->id]) }}" method="POST">

                                                @csrf
                                                <button class="btn button-color">Carrito</button>
                                            </form>
                                        </td>
                                        <td><form action="{{ route('delete', [$producto->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn button-color">Eliminar</button>
                                            </form>
                                        </td>
                                        <td><form action="{{ route('show', ['id'=> $producto->id]) }}" >
                                                @csrf
                                                <button class="btn button-color ">Editar</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                @else

                                @endif
                                </tbody>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">

                            </div>
                        </div>
                    </table>


            </div>

        </div>
    </div>
@endsection

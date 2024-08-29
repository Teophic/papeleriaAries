@extends('Partials/navbar')

@section('content')
    <div class="d-flex falign-self-stretch gap-3" >
        <div class="container p-4   align-self-center" >
            <form class="mx-5" action="{{ route('save') }}" method="POST">
                @csrf

                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success')}}</h6>
                @endif

                @error('id')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                @error('nombre')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                @error('marca')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                @error('precio')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                @error('stock')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                    <label for="id" class="form-label">Codigo</label>
                    <input type="number" min="0" name="id" class="form-control" autofocus>
                </div>
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
                </div>
                <button type="submit" class="btn button-body-color ">Agregar</button>
            </form>
    </div>
    </div>

    <!--
    <div class="flex-column align-self-end" style="background-color: blue;">
        <div class="p-4 align-self-start" style="background-color: white;">uno</div>
        <div class="p-4 align-self-center" style="background-color: gray;">dos</div>
        <div class="p-4 align-self-end" style="background-color: white;">tres</div>
    </div>
    <div class="table-responsive p-4 w-50 align-self-start" style="background-color: gray;">

            <div class="table">

            </div>

        </div>
    -->
@endsection

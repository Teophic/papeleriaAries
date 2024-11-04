<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css\app.css') }}">
    <link rel="icon" href="{{ asset('img\logo.png') }}" type="image/png">
    <title>Aries</title>
</head>
<body class="background-body" >
    <!--text-bg-dark  data-bs-theme="dark"-->
    <header>
        <nav class="navbar sticky-top background-nav navbar-expand-lg " >
            <div class="container-fluid align-items-center">
                    <a class="navbar-brand " href="{{URL::to('/')}}" style="width:100px;height:100px;border-radius: 50%">
                        <img src="{{asset('img\logo.png') }}" class="" alt="Logo" style="width:100px;height:100px">
                    </a>

                <div class="collapse navbar-collapse justify-content-end" id="">
                    <ul class=" navbar-nav  nav-fill">
                        <li class="nav-item"><a class="nav-link  text-color" href="{{URL::to('Agregar')}}">Agregar Producto</a></li>
                        <li class="nav-item"><a class="nav-link text-color" href="{{URL::to('Stock')}}">Buscar</a></li>
                        <li class="nav-item"><a class="nav-link text-color" href="{{URL::to('Dashboard')}}">Dashboard</a></li>
                    </ul>
            </div>
            </div>

        </nav>
    </header>
    @include('sweetalert::alert')
    @yield('content')
</body>
</html>

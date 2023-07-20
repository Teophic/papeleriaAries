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
        <nav class="navbar sticky-top background-nav" >
            <div class="container-fluid align-items-center">
                <a class="navbar-brand " href="{{URL::to('/')}}" style="width:100px;height:100px;border-radius: 50%"><img src="{{asset('img\logo.png') }}" class="" alt="Logo" style="width:100px;height:100px"></a>
                    <button class="navbar-toggler background-button-nav" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end background-inner-nav" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title background-offcanva-nav-text" style="font-size: 25px;" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body ">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 ">
                            <li class="nav-item">
                                <a class="nav-link background-offcanva-nav-text" aria-current="page" href="{{URL::to('/')}}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle background-offcanva-nav-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Inventario</a>
                                <ul class="dropdown-menu background-inner-nav ">
                                    <li ><a class="nav-link " href="{{URL::to('Agregar')}}">Agregar Producto</a></li>
                                    <li><a class="nav-link" href="{{URL::to('Stock')}}">Buscar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @include('sweetalert::alert')
    @yield('content')
</body>
</html>
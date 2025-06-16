<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrega de Boletines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cargar Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Ajustar la barra de navegación a blanco */
        .navbar {
            background-color: white !important;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el título de la barra de navegación */
        .custom-navbar-title {
            font-size: 32px;  /* Tamaño del texto */
            font-weight: bold; /* Peso de la fuente */
            color: #4a4a4a;    /* Color del texto */
            font-family: 'Roboto', sans-serif; /* Tipo de fuente cambiado a Roboto */
            letter-spacing: 1px; /* Espaciado entre letras */
        }

        /* Ajustar el fondo de la sección de boletines a gris */
        .boletines-container {
            background-color: #d9d9d9;
            padding: 50px 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        /* Estilos para los botones */
        .btn-custom {
            width: 200px;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            margin: 10px;
            background-color: #253f64;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }

    </style>
</head>

<body>
    <header>
        <!-- Barra de navegación en blanco -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand custom-navbar-title" >
                    <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" width="95" height="80" class="d-inline-block align-text-top">
                </a>
                
                <h2>FUNDACIÓN JEISON</h2>
 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <a class="nav-link" href="{{route('quienesSomos')}}">¿Quiénes Somos?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contactos')}}">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cupo Asodisvalle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cupo PBJ</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vacantes</a>
                        </li>    
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sección de boletines con fondo gris -->
        <div class="container text-center boletines-container">
            <h1 class="display-5">Entrega de Boletines </h1>
            <p class="lead">Accede a tus boletines, certificados y constancias de manera rápida y segura.</p>

            <!-- Botones de redireccionamiento -->
            <div class="d-flex justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-custom">ASODISVALLE</a>
                <a href="{{ route('loginPBJ') }}" class="btn btn-custom">P.B.J</a>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
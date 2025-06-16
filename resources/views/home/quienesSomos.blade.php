<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>¿Quienes Somos?</title>
    <style>
        /* Barra de navegación */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            height: 50px; /* Ajusta la altura del nav */
            padding: 20px 30px; /* Ajusta el relleno interno */
        }
    
        .logo {
            height: 80px; /* Aumentado el tamaño del logo */
            width: auto;
        }
    
        .regresar {
            height: 35px; /* Aumentado el tamaño del botón de regresar */
            width: auto;
            cursor: pointer;
        }
        h1 {
            color: #000000;
            margin-bottom: 20px;
        }
        </style>
</head>
<body>
        <!-- Barra de Navegación -->
        <header class="nav-header">
            <!-- Logo (Izquierda) -->
            <a href="#">
                <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
            </a>
            <h1>¿Quienes Somos?</h1>
    
            <!-- Icono Regresar (Derecha) -->
            <a href="{{ route('home.index') }}">
                <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
            </a>
        </header>
    
    <p>Hola</p>
</body>
</html>
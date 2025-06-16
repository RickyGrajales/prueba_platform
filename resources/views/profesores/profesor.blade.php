<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profesor</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-width: 80px;
        }

        .welcome {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
            margin: 0 20px;
        }

        .logout img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .container {
            display: flex;
        }

        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 10px;
            height: 100vh;
            /* box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); */
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: rgb(0, 0, 0);
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #444;
            color: white;
        }

        .content {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome">Bienvenido Estimado Profesor</div>
        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('img/CerrarSesion.png') }}" alt="Cerrar Sesión">
        </a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <!-- Unificar todos los enlaces en un solo bloque -->
            <a href="{{ url('/profesores/actualizarDatos') }}">Actualizar Datos</a>
            <a href="{{ route('profesor.grado',) }}" class="sidebar-link">Asistencia</a>
        </div>


    </div>

</body>
</html>

 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profesor P.B.J</title>
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
/* ////// */

        .sidebar-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
/* 
        .dropdown-toggle {
            background-color: transparent;
            border: none;
            color: #fff;
            text-align: left;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        } */

        .dropdown-toggle {
            background-color: transparent;
            border: none;
            color: #000000; /* negro en lugar de blanco */
            text-align: left;
            width: 100%;
            padding: 13px;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-toggle:hover {
            background-color: #444;
            color: white;
            border-radius: 5px;
        }



        .dropdown-menu {
            display: none;
            flex-direction: column;
            background-color: #ffffff;
            position: absolute;
            left: 0;
            top: 100%;
            min-width: 200px;
            z-index: 1000;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .sidebar-dropdown:hover .dropdown-menu {
            display: flex;
        }

        .dropdown-item {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #495057;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome">Profesor P.B.J</div>
        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('img/CerrarSesion.png') }}" alt="Cerrar Sesión">
        </a>
        
        <form id="logout-form" action="{{ route('logoutPBJ') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <!-- Unificar todos los enlaces en un solo bloque -->
            <a href="{{ route('profesor.editar') }}" class="sidebar-link">Actualizar Datos</a>
            <a href="{{ route('profesorPBJ.grado') }}" class="sidebar-link">Asistencia</a>
            <div class="sidebar-dropdown">
                <button class="sidebar-link dropdown-toggle">Notas</button>
                <div class="dropdown-menu">
                    <a href="{{ route('notas.primerPeriodo') }}" class="dropdown-item">Período 1</a>
                    <a href="{{ route('notas.segundoPeriodo') }}" class="dropdown-item">Período 2</a>
                    <a href="{{ route('notas.tercerPeriodo') }}" class="dropdown-item">Período 3</a>
                    <a href="{{ route('notas.cuartoPeriodo') }}" class="dropdown-item">Período 4</a>
                </div>
            </div>       
         </div>
    </div>

    
</body>


</html>






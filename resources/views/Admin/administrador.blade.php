<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        /* Estilo para la cabecera */
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

        /* Contenedor principal */
        .container {
            display: flex;
            /* padding: 20px; */
            justify-content: space-between;
        }

        /* Estilo para el menú lateral */
        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(255, 255, 255, 0.1);
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

        .sidebar p {
            font-size: 18px;
            margin: 10px 0;
        }

        .sidebar strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome">Bienvenido Administrador</div>
        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('img/CerrarSesion.png') }}" alt="Cerrar Sesión">
        </a>
        
        
        <!-- Formulario de logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="container">
        <!-- Menú lateral -->
        <div class="sidebar">
            <a href="{{ route('admin.registro') }}" class="sidebar-link">Crear Usuarios</a>
            <a href="{{ route('admin.editar') }}" class="sidebar-link">Actualizar Datos</a>
            <a href="{{ route('encuesta.alumno') }}" class="sidebar-link">Encuesta Alumno</a>
            <a href="{{ route('admin.crear_grado') }}" class="sidebar-link">Crear Grado</a>
            <a href="{{route('admin.eventos')}}" class="sidebar-link">Crear Evento</a>
            <a href="{{ route('admin.materias.index') }}" class="sidebar-link">Ver Materias</a>
        </div>
    </div>
</body>
</html>


{{-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        /* Estilo para la cabecera */
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

        /* Contenedor principal */
        .container {
            display: flex;
            justify-content: space-between;
        }

        /* Estilo para el menú lateral */
        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(255, 255, 255, 0.1);
        }

        /* Estilo para el select personalizado */
        .sidebar-select {
            width: 100%;
            padding: 12px;
            color: rgb(0, 0, 0);
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
        }

        .sidebar-select option {
            padding: 10px;
            color: rgb(0, 0, 0);
            background-color: #fff;
        }

        /* Hover para el select (como los links anteriores) */
        .sidebar-select:hover {
            background-color: #444;
            color: #fff;
        }

        .sidebar-select:focus {
            outline: none;
            border-color: #444;
        }

        .content {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar p {
            font-size: 18px;
            margin: 10px 0;
        }

        .sidebar strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome">Bienvenido Administrador</div>
        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('img/CerrarSesion.png') }}" alt="Cerrar Sesión">
        </a>

        <!-- Formulario de logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="container">
        <!-- Menú lateral con select en lugar de enlaces -->
        <div class="sidebar">
            <select class="sidebar-select" onchange="if (this.value) window.location.href=this.value;">
                <option disabled selected>Selecciona una opción</option>
                <option value="{{ route('admin.registro') }}">Crear Usuarios</option>
                <option value="{{ route('admin.editar') }}">Actualizar Datos</option>
                <option value="{{ route('encuesta.alumno') }}">Encuesta Alumno</option>
                <option value="{{ route('admin.crear_grado') }}">Crear Grado</option>
                <option value="{{ route('admin.eventos') }}">Crear Evento</option>
            </select>
        </div>
    </div>
</body>

</html>
  --}}

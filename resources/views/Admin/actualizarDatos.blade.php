<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        /* Barra de navegación */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 15px 30px;
        }
        .nav-header {
            height: 50px; /* Ajusta la altura del nav */
            padding: 20px 30px; /* Ajusta el relleno interno */
        }

        .logo {
            height: 80px; /* Aumentado el tamaño del logo */
            width: auto;
        }

        .regresar {
            height: 27px; /* Aumentado el tamaño del botón de regresar */
            width: auto;
            cursor: pointer;
        }

        /* Contenedor del formulario */
        .form-container {
            background: white;
            max-width: 600px;
            margin: 50px auto;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #000000;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            width: 90%;
            text-align: left;
            font-weight: bold;
            margin-top: 15px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 45%;
            margin-top: 20px;
            padding: 12px;
            background-color: #004080;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #003366;
        }

        .mensaje {
            color: green;
            font-weight: bold;
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
        <h1>Actualizar Datos del Administrador</h1>
        <!-- Icono Regresar (Derecha) -->
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <div class="form-container">
        <h3>Formulario</h3>

        @if (session('mensaje'))
            <p class="mensaje">{{ session('mensaje') }}</p>
        @endif

        <form action="{{ route('admin.actualizar') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $administrador->nombre) }}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $administrador->email) }}" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $administrador->telefono) }}">

            <!-- Campos para actualizar contraseña -->
            <label for="password">Nueva Contraseña (dejar en blanco si no desea cambiarla):</label>
            <input type="password" name="password" id="password">

            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            
            <br>

            <button type="submit">Actualizar Datos</button>

       </div>
       
        </form>
    </div>

</body>
</html>

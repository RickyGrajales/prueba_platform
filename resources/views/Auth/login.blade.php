<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Barra de navegación */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #ffffff;
            width: 100%; /* Asegura que ocupe todo el ancho */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .nav-header {
            height: 95px;
            padding: 8px 20px;
        }

        .logo {
            height: 80px; /* Ajusta el tamaño del logo aquí */
            width: auto;
        }

        .regresar {
            height: 27px; /* Ajusta el tamaño del icono regresar aquí */
            width: auto;
        }

        /* Estilos para el login */
        body {
            background-color: #f8f9fa;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px; /* Para evitar que el formulario quede debajo de la barra de navegación */
        }

        .login-container {
            background-color: white;
            padding: 60px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;

        }

        .form-control, .form-select {
            margin-bottom: 15px;
        }

        button {
            width: 100%;
        }

        h2, h3 {
            text-align: center;
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
        <h1>COLEGIO ASODISVALLE</h1>

        <!-- Icono Regresar (Derecha) -->
        <a href="{{ url('home') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <!-- Formulario de Login -->
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <br>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="username" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="username" name="usuario" value="{{ old('usuario') }}" placeholder="Ingresa tu usuario" required>
            @error('usuario')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        
            {{-- <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recuérdame</label>
            </div>
         --}}
            <a href="">¿Recuperar contraseña?</a>
            <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
        </form>
        
        
        
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






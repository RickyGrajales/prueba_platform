<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Eventos</title>
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

        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
        .evento { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #fff; }
        .evento h3 { margin: 0; }
        .evento p { margin: 5px 0; }
    </style>
</head>
<body>
        <!-- Barra de Navegación -->
        <header class="nav-header">
            <!-- Logo (Izquierda) -->
            <a href="#">
                <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
            </a>
            
            <h1>Notificación de Eventos</h1>
    
            <!-- Icono Regresar (Derecha) -->
            <a href="{{ url('estudiantes/estudiante') }}">
                <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
            </a>
        </header>

<h2>Eventos Próximos</h2>

@if(count($eventos) > 0)
    @foreach($eventos as $evento)
        <div class="evento">
            <h3>{{ $evento->titulo }}</h3>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
            <p>{{ $evento->descripcion }}</p>
        </div>
    @endforeach
@else
    <p>No hay eventos próximos.</p>
@endif

</body>
</html>

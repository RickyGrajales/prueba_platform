<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación P.B.J</title>
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
    </style>

</head>
<body>
    <!-- Barra de Navegación -->
    <header class="nav-header">
        <!-- Logo (Izquierda) -->
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        
        <h1>Proximos Eventos P.B.J</h1>

        <!-- Icono Regresar (Derecha) -->
        <a href="{{ route('estudiantePBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>
    {{-- @if(count($eventos) > 0) --}}
    @if($eventos && $eventos->isNotEmpty())
    <div style="padding: 20px;">
        {{-- <h2>Próximos Eventos</h2> --}}
        <ul style="list-style: none; padding: 0;">
            @foreach($eventos as $evento)
                <li style="background: white; margin-bottom: 10px; padding: 15px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <strong>{{ $evento->titulo }}</strong><br>
                    <small><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</small><br>
                    <p>{{ $evento->descripcion }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <div style="padding: 20px;">
        <p>No hay eventos próximos.</p>
    </div>
@endif


 


</body>
</html>
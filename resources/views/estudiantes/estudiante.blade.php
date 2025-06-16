<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
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
            flex-grow: 1;
        }
        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 10px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(56, 36, 36, 0.1);
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            color: #333;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #444;
            color: white;
        }
        .descargas-container {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }
        .descargas {
            display: flex;
            flex-wrap: wrap;
            gap: 100px;
            justify-content: center;
            align-items: center;
        }
        .descargas div {
            text-align: center;
            position: relative;
        }
        .descargas img {
            width: 100px;
            height: 100px;
            cursor: pointer;
            border-radius: 15px;
            border: 2px solid #ccc;
            transition: transform 0.3s ease-in-out;
            object-fit: contain;
        }
        .descargas img:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 10px rgba(140, 38, 38, 0.3);
        }
        .descargas p {
            margin-top: 8px;
            font-size: 16px;
            font-weight: bold;
        }
        .notificacion {
            position: absolute;
            top: 5px;
            right: 10px;
            width: 15px;
            height: 15px;
            background-color: red;
            border-radius: 50%;
            display: none;
        }

        .notificacion {
            position: absolute;
            top: 5px;
            right: 10px;
            width: 15px;
            height: 15px;
            background-color: red;
            border-radius: 50%;
            display: none;
        }

        .notificacion.show {
            display: block;
        }


    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome">Bienvenido Estimado Alumno</div>
        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('img/CerrarSesion.png') }}" alt="Cerrar Sesión">
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="container">
        <div class="sidebar">
            <a href="{{ route('estudiantes.editar') }}">Actualizar Datos</a>
        </div>
        <div class="descargas-container">
            <div class="descargas">
                <div>
                    <a href="{{ route('estudiantes.encuesta') }}">
                        <img src="{{ asset('img/encuesta.png') }}" alt="Encuesta">
                        <div id="notificacion-encuesta" class="notificacion"></div>
                    </a>
                    <p>Encuesta</p>
                </div>
                
                <div>
                    <a href="{{ route('calendario.ver') }}">
                        <img src="{{ asset('img/calendario.png') }}" alt="Calendario">
                        @if($hayNuevosEventos ?? false)
                            <div id="notificacion-calendario" class="notificacion" style="display: block;"></div>
                        @endif
                    </a>
                    <p>Eventos</p>
                </div>
                
                <div>
                    <a href="{{ route('descargar.boletin', ['archivo' => 'boletin.pdf']) }}">
                    <img src="{{ asset('img/boletin.png') }}" alt="Boletines">
                    </a>
                    <p>Boletines</p>
                </div>
                <div>
                    <a href="{{ route('descargar.certificados', ['archivo' => 'certificado.pdf']) }}">
                    <img src="{{ asset('img/certificados.png') }}" alt="Certificados">
                    </a>
                    <p>Certificados</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta P.B.J</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Barra de navegación */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            width: 100%;
            height: 65px;
            padding: 20px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            height: 80px;
            width: auto;
        }

        .regresar {
            height: 27px;
            cursor: pointer;
            padding: 0px;
            width: auto;
        }

        /* Contenedor principal */
        .form-container {
            width: 90%;
            max-width: 700px;
            background: white;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 20px 0;
            flex-grow: 1;
        }

        /* Estilo de preguntas */
        .pregunta {
            text-align: left;
            margin-bottom: 20px;
        }

        .pregunta label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .respuesta-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Botón de envío */
        .submit-btn {
            background-color: blue;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background-color: darkblue;
        }

        /* Diseño responsivo */
        @media (max-width: 600px) {
            .form-container {
                width: 95%;
                padding: 15px;
            }

            .nav-header {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<!-- Barra de Navegación -->
<header class="nav-header">
    <a href="#">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
    </a>
    <h1>Encuesta P.B.J</h1>
    <a href="{{ route('estudiantePBJ.inicio') }}">
        <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
    </a>
</header>

<!-- Contenedor de la Encuesta -->
<div class="form-container">
    <h2>Encuesta de Satisfacción</h2>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success" style="color: green; padding: 10px; border: 1px solid green; border-radius: 5px; background-color: #e0ffe0;">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger" style="color: red; padding: 10px; border: 1px solid red; border-radius: 5px; background-color: #ffe0e0;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario de Encuesta -->
    <form action="{{ route('estudiantePBJ.encuesta.responder') }}" method="POST">
        @csrf
        @if (!$encuestaRespondida)

            @foreach ($preguntas as $pregunta)
                <div class="pregunta">
                    <label>{{ $pregunta->pregunta }}</label>
                    <div>
                        <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="Sí" required> Sí
                        <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="No"> No
                        <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="Tal vez"> Tal vez
                    </div>
                </div>
                <br>
            @endforeach
        @endif

        <br>

        <!-- Desactivar el botón si la encuesta ya fue respondida -->
        <button type="submit" class="submit-btn" @if($encuestaRespondida) disabled @endif>Enviar Respuestas</button>
    </form>
</div>

</body>
</html>

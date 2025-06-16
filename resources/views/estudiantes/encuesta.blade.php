<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
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

        /* Opciones de respuesta */
        .opciones {
            display: flex;
            gap: 15px;
        }

        .opciones label {
            font-weight: normal;
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
    <h1>Bienvenido Alumno</h1>
    <a href="{{ url('estudiantes/estudiante') }}">
        <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
    </a>
</header>

<!-- Contenedor de la Encuesta -->
<div class="form-container">
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(isset($respuestas) && $respuestas->count() > 0)
        <p style="color: green;">¡Gracias por responder la encuesta!</p>
    @else
        <!-- Mostrar formulario si no ha respondido -->
        <form action="{{ route('estudiantes.guardarRespuestas') }}" method="POST">
            @csrf
            <div id="preguntas-container">
                @if ($preguntas->isNotEmpty())
                    @foreach ($preguntas as $pregunta)
                        <div class="pregunta">
                            <label>{{ $pregunta->texto }}</label>
                            <input type="hidden" name="preguntas[]" value="{{ $pregunta->id }}">

                            <!-- Opciones de respuesta -->
                            <div class="opciones">
                                <label>
                                    <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="Sí" required> Sí
                                </label>
                                <label>
                                    <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="No" required> No
                                </label>
                                <label>
                                    <input type="radio" name="respuestas[{{ $pregunta->id }}]" value="Tal vez" required> Tal vez
                                </label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay preguntas disponibles en este momento.</p>
                @endif
            </div>

            <button type="submit" class="submit-btn">Enviar</button>
        </form>
    @endif
</div>

</body>
</html>

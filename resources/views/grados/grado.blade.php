<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $grado }} - Asistencia</title>
    <link rel="stylesheet" href="{{ asset('css/grado.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            height: 50px;
            padding: 20px 30px;
        }
        .logo {
            height: 80px;
            width: auto;
        }
        .regresar {
            height: 27px;
            width: auto;
            cursor: pointer;
        }
        .contenido {
            margin-top: 20px;
        }
        .lista-estudiantes {
            list-style: none;
            padding: 0;
        }
        .lista-estudiantes li {
            background: white;
            margin: 10px auto;
            padding: 15px;
            width: 70%;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .opciones-asistencia {
            display: flex;
            gap: 15px;
        }
        .opciones-asistencia label {
            cursor: pointer;
        }
        .excusa {
            display: none;
            width: 200px;
            margin-left: 15px;
        }
        .btn-guardar {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <header class="nav-header">
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1> Asistencia </h1>
        <br>
        <h2>Grado: {{ $grado }}</h2>
        <a href="{{ url('profesores/profesor') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <div class="contenido">
        @if($profesor)
            <p><strong>Profesor:</strong> {{ $profesor->nombre }}</p>
        @else
            <p>No hay profesor asignado a este grado.</p>
        @endif

        @if($estudiantes->isNotEmpty())
            <form action="{{ route('guardar.asistencia') }}" method="POST">
                @csrf
                <ul class="lista-estudiantes">
                    @foreach($estudiantes as $estudiante)
                        <li>
                            <span>{{ $estudiante->nombre }}</span>
                            {{-- <strong>Nombre:</strong> --}}
                            <div class="opciones-asistencia">
                                <label>
                                    <input type="radio" name="asistencia[{{ $estudiante->id }}]" value="si" onclick="toggleExcusa({{ $estudiante->id }}, false)"> Sí
                                </label>
                                <label>
                                    <input type="radio" name="asistencia[{{ $estudiante->id }}]" value="no" onclick="toggleExcusa({{ $estudiante->id }}, true)"> No
                                </label>
                                <input type="text" name="excusa[{{ $estudiante->id }}]" id="excusa-{{ $estudiante->id }}" class="excusa" placeholder="Escriba la excusa aquí">
                            </div>
                        </li>
                    @endforeach
                </ul>
                <button type="submit" class="btn-guardar">Guardar Asistencia</button>
            </form>
        @else
            <p>No hay estudiantes asignados a este grado.</p>
        @endif
    </div>

    <script>
        function toggleExcusa(id, mostrar) {
            const campoExcusa = document.getElementById("excusa-" + id);
            if (mostrar) {
                campoExcusa.style.display = "block";
            } else {
                campoExcusa.style.display = "none";
                campoExcusa.value = "";
            }
        }
    </script>

</body>
</html>

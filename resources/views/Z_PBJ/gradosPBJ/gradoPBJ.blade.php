<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grado P.B.J</title>

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
            padding: 15px 30px;
        }

        .logo {
            height: 80px;
            width: auto;
        }

        .regresar {
            height: 27px;
            cursor: pointer;
            width: auto;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .content {
            background-color: #fff;
            padding: 30px;
            width: 80%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        input[type="text"] {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    {{-- Mensajes de éxito o error --}}
    @if (session('mensaje'))
        <div class="alert alert-success" id="mensaje-alerta">
            {{ session('mensaje') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-alerta">
            {{ session('error') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <header class="nav-header">
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>{{ $profesor->nombre }}</h1>
        <h2>Grado: {{ $profesor->grado }}</h2>
        <a href="{{ route('profesorPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    {{-- Contenido principal --}}
    <div class="container">
        <div class="content">
            <h3>Asistencia del Día</h3>

            <form action="{{ route('asistencia.store') }}" method="POST">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Asistió</th>
                            <th>Excusa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>
                                    <input type="radio" name="asistencia[{{ $estudiante->id }}]" value="1"> Sí
                                    <input type="radio" name="asistencia[{{ $estudiante->id }}]" value="0"> No
                                </td>
                                <td>
                                    <input type="text" name="excusa[{{ $estudiante->id }}]" placeholder="Excusa (si aplica)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($yaRegistrada)
                    <p style="color: red; font-weight: bold;">La asistencia ya fue registrada hoy.</p>
                    <button type="submit" disabled style="background-color: gray; cursor: not-allowed;">Asistencia Ya Registrada</button>
                @else
                    <button type="submit">Registrar Asistencia</button>
                @endif
            </form>
        </div>
    </div>

    {{-- Script para ocultar mensajes luego de 5 segundos --}}
    <script>
        setTimeout(function () {
            let mensaje = document.getElementById('mensaje-alerta');
            let error = document.getElementById('error-alerta');
            if (mensaje) mensaje.style.display = 'none';
            if (error) error.style.display = 'none';
        }, 5000);
    </script>
</body>
</html>

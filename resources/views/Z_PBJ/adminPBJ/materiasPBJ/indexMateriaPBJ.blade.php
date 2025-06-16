<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materias P.B.J</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header{
            height: 80px;
        }

        .logo {
            max-width: 80px;
        }

        .regresar {
            width: auto;
            height: 27px;
            cursor: pointer;
            margin-right: 20px;
        }

        .welcome {
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        button {
            padding: 6px 12px;
            margin-right: 5px;
        }

        input[type="text"] {
            padding: 6px;
            width: 50%;
        }

        .form-agregar {
            margin-bottom: 30px;
        }

        .mensaje {
            color: green;
            margin-bottom: 15px;
        }
        
        
        .agregar{
            background-color: rgb(67, 158, 255);
        }


        .actualizar{
            background-color: rgb(0, 255, 136);
        }


        .eliminar{
            background-color: red;
        }



    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome"><h1>Materias P.B.J</h1></div>
        <a href="{{ route('adminPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>

    <div style="width: 80%; margin-top: 30px;">
        @if(session('success'))
            <div class="mensaje">{{ session('success') }}</div>
        @endif

        <form action="{{ route('materiasPBJ.store') }}" method="POST" class="form-agregar">
            @csrf
            <label for="nombre">Nueva Materia:</label><br>
            <input type="text" name="nombre" id="nombre" required>
            <button class="agregar" type="submit">Agregar</button>
        </form>

        <h2>Materias Registradas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $materia)
                    <tr>
                        <form action="{{ route('materiasPBJ.update', $materia->id) }}" method="POST">
                            @csrf
                             @method('PUT')
                            <td>
                                <input type="text" name="nombre" value="{{ $materia->nombre }}" required>
                            </td>
                            <td>
                                <button class="actualizar" type="submit">Actualizar</button>
                                </form>
                                <form action="{{ route('materiasPBJ.destroy', $materia->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="eliminar" type="submit" onclick="return confirm('¿Eliminar esta materia?')">Eliminar</button>
                                </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

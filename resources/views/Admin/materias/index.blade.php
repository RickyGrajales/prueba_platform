<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Materias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            height: 85px; /* Ajusta la altura del nav */
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
        <h1>Gestión de Materias</h1>
        <!-- Icono Regresar (Derecha) -->
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>


    <div class="container mt-4">
        <h2>Listado de Materias</h2>
        <!-- Tabla de materias -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Porcentual</th>
                    <th>Grado</th>
                    <th>Profesor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materias as $materia)
                <tr>
                    <td>{{ $materia->id }}</td>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->porcentual }}%</td>
                    <td>{{ $materia->grado->nombre ?? 'Sin asignar' }}</td>
                    <td>{{ $materia->profesor->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <!-- Botón para editar la materia -->
                        <a href="{{ route('admin.materias.edit', $materia->id) }}" class="btn btn-warning">Editar</a>

                        <!-- Formulario para eliminar la materia -->
                        <form action="{{ route('admin.materias.destroy', $materia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No hay materias registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
         <!-- Botón para crear una nueva materia -->
         <a href="{{ route('admin.materias.crear') }}" class="btn btn-primary mb-3">Crear Nueva Materia</a>

        </div>
</body>
</html>

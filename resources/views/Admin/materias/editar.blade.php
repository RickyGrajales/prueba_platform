<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia</title>
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
            padding: 20px 30px;
            height: 85px;
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

        /* Contenedor del formulario */
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <header class="nav-header">
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>Editar Materia</h1>
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <!-- Contenedor del Formulario -->
    <div class="form-container">
        <h2>Editar Materia</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.materias.update') }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="materia_id" value="{{ $materia->id }}">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Materia:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $materia->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="porcentual" class="form-label">Porcentaje:</label>
                <input type="number" name="porcentual" id="porcentual" class="form-control" min="0" max="100" value="{{ $materia->porcentual }}" required>
            </div>

            <div class="mb-3">
                <label for="grado_id" class="form-label">Grado:</label>
                <select name="grado_id" id="grado_id" class="form-control" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ $materia->curso_id == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="profesor_id" class="form-label">Profesor:</label>
                <select name="profesor_id" id="profesor_id" class="form-control" required>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}" {{ $materia->profesor_id == $profesor->id ? 'selected' : '' }}>
                            {{ $profesor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Materia</button>
                <a href="{{ route('admin.materias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

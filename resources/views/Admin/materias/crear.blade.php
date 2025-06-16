<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nueva Materia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

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

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #343a40;
            font-size: 24px;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ced4da;
        }

        button {
            width: 40%;
            padding: 12px;
        }

        /* Mejoras en Select2 */
        .select2-container--classic .select2-selection--single {
            height: 38px;
            padding: 5px;
            border-radius: 6px;
        }

        .select2-container--classic .select2-selection__rendered {
            line-height: 30px;
        }

        .select2-container--classic .select2-selection__arrow {
            height: 34px;
        }

    </style>
</head>
<body>
    <header class="nav-header">
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>Crear Nueva Materia</h1>
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.materias.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Materia:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="porcentual" class="form-label">Porcentaje:</label>
                <input type="number" name="porcentual" id="porcentual" class="form-control" min="0" max="100" required>
            </div>

            <!-- Selección de cursos con Select2 corregido -->
            <div class="mb-3">
                <label for="curso_id" class="form-label">Curso:</label>
                <select name="curso_id" id="curso_id" class="form-control select2" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="profesor_id" class="form-label">Profesor:</label>
                <select name="profesor_id" id="profesor_id" class="form-control select2" required>
                    <option value="">Seleccione un profesor</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Materia</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccione una opción",
                minimumResultsForSearch: -1, // Desactiva el campo de búsqueda
                allowClear: true,
                width: '100%',
                theme: "classic"
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro PBJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #ffffff;
            width: 100%;
            height: 90px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .logo {
            height: 80px;
            width: auto;
        }

        .regresar {
            height: 27px;
            width: auto;
        }

        body {
            margin: 0;
            padding-top: 100px;
            background-color: #f8f9fa;
        }

        .Contenedor_registro {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-control, .form-select {
            margin-bottom: 15px;
        }

        button {
            width: 100%;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="nav-header">
        <a href="{{ url('pagPrincipal') }}">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>Crear Nuevos Usuarios PBJ</h1>

        <a href="{{ route('adminPBJ.administradorPBJ') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
        
    </header>

    <div class="Contenedor_registro">
        <h2>Formulario</h2>
        <br><br>
        <form action="{{ route('usuariosPBJ.store') }}" method="POST">
            @csrf
            
            <label for="role" class="form-label">Selecciona el rol:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin">Administrador</option>
                <option value="evaluador_pedagogico">Evaluador Pedagógico</option>
                <option value="profesor">Profesor</option>
                <option value="estudiante">Estudiante</option>
            </select>
            
            <label for="nombre" class="form-label">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Digite aquí..." required>
            
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico..." required>
            
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Número telefónico..." value="{{ old('telefono') }}">
            
            <label for="usuario" class="form-label">Usuario (Número de documento):</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Número de documento..." required>
            
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Su contraseña..." required>
            
        
            <div id="gradoContainer">
                <label for="grado" class="form-label">Asignar grado:</label>
                <select class="form-select" id="grado" name="grado">
                    <option value="">Selecciona un grado</option>
                    <option value="1">  Grado  1</option>
                    <option value="2">  Grado  2</option>
                    <option value="3">  Grado  3</option>
                    <option value="4">  Grado  4</option>
                    <option value="5">  Grado  5</option>
                    <option value="6">  Grado  6</option>
                    <option value="7">  Grado  7</option>
                    <option value="8">  Grado  8</option>
                    <option value="9">  Grado  9</option>
                    <option value="10"> Grado 10</option>
                    <option value="11"> Grado 11</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Registrar</button>
        </form>
    </div>

    {{-- //Arreglar esta función ara que me guarde el grado
    en forma de texto y no numérico --}}
    
    {{-- <div id="gradoContainer">
                <label for="grado" class="form-label">Asignar grado:</label>
                <select class="form-select" id="grado" name="grado">
                    <option value="">Selecciona un grado</option>
                    <option value="1">  Grado  Primero</option>
                    <option value="2">  Grado  Segundo</option>
                    <option value="3">  Grado  Tercero</option>
                    <option value="4">  Grado  Cuarto</option>
                    <option value="5">  Grado  Quinto</option>
                    <option value="6">  Grado  Sexto</option>
                    <option value="7">  Grado  Séptimo</option>
                    <option value="8">  Grado  Octavo</option>
                    <option value="9">  Grado  Noveno</option>
                    <option value="10"> Grado  Decimo</option>
                    <option value="11"> Grado  Once</option>
                </select>
            </div>           
            
            <button type="submit" class="btn btn-primary mt-3">Registrar</button>
        </form>
    </div> --}}

    <script>
        function actualizarFormulario() {
            let role = document.getElementById("role").value;
            let gradoContainer = document.getElementById("gradoContainer");
            
            if (role === "admin" || role === "evaluador_pedagogico") {
                gradoContainer.style.display = "none";
            } else {
                gradoContainer.style.display = "block";
            }
        }

        document.getElementById("role").addEventListener("change", actualizarFormulario);
        actualizarFormulario();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

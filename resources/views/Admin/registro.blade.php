<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Barra de navegación */
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

        /* Estilo del body */
        body {
            margin: 0;
            padding-top: 100px;
            background-color: #f8f9fa;
        }

        /* Estilo del contenedor de registro */
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

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <header class="nav-header">
        <!-- Logo (Izquierda) -->
        <a href="{{ url('pagPrincipal') }}">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>

        <!-- Icono Regresar (Derecha) -->
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <!-- Contenedor de Registro -->
    <div class="Contenedor_registro">
        <h1>Registro de usuarios</h1>
        <br><br>
        <!-- Formulario de Registro -->
        <form action="{{ route('registro') }}" method="POST">
            @csrf

            <!-- Campo de Rol -->
            <label for="role" class="form-label">Selecciona tu rol:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin">Administrador</option>
                <option value="evaluador_pedagogico">Evaluador Pedagógico</option>
                <option value="profesor">Profesor</option>
                <option value="estudiante">Estudiante</option>


            </select>

            <!-- Campo de Nombre -->
            <label for="nombre" class="form-label">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Digite aquí..." required>

            <!-- Campo de E-mail -->
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico..." required>

            <!-- Campo para Número Telefónico -->
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" placeholder="Número telefonico..." id="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>

            {{-- <label for="cedula" class="form-label">Cedula:</label>
            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Número de documento..." required> --}}
            <!-- Campo de Usuario -->
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Número de documento..." required>

            <!-- Campo de Contraseña -->
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Su contraseña..." required>

            <!-- Campo de Grado -->
            <div id="gradoContainer">
                <label for="grado" class="form-label">Selecciona tu grado:</label>
                <select class="form-select" id="grado" name="grado" required>
                    <option value="Transición A">Transición A</option>
                    <option value="Jardin">Jardín</option>
                    <option value="Pimer Grado">Primer Grado</option>
                    <option value="Segundo Grado">Segundo Grado</option>
                    <option value="Tercer Grado">Tercer Grado</option>
                    <option value="Cuarto Grado">Cuarto Grado</option>
                </select>
            </div>

            <!-- Pregunta sobre discapacidad -->
            <div id="discapacidadContainer">
                <label for="discapacidad" class="form-label">¿Tiene alguna discapacidad?</label>
                <select class="form-select" id="discapacidad" name="discapacidad" required onchange="mostrarCampoDiscapacidad()">
                    <option value="no">No</option>
                    <option value="si">Sí</option>
                </select>

                <!-- Campo para describir la discapacidad (oculto por defecto) -->
                <div id="descripcionDiscapacidadContainer" style="display: none;">
                    <label for="descripcionDiscapacidad">Descripción de la Discapacidad (opcional)</label>
                    <textarea name="descripcionDiscapacidad" id="descripcionDiscapacidad"></textarea>
                </div>
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary mt-3">Registrar</button>
        </form>
    </div>

    <script>
        function mostrarCampoDiscapacidad() {
            let select = document.getElementById("discapacidad");
            let descripcionContainer = document.getElementById("descripcionDiscapacidadContainer");
            descripcionContainer.style.display = select.value === "si" ? "block" : "none";
        }

        document.addEventListener("DOMContentLoaded", function() {
            let roleSelect = document.getElementById("role");
            let gradoLabel = document.querySelector("label[for='grado']");
            let gradoContainer = document.getElementById("gradoContainer");
            let discapacidadContainer = document.getElementById("discapacidadContainer");

            // function actualizarFormulario() {
            //     let role = roleSelect.value;

            //     if (role === "admin") {
            //         gradoContainer.style.display = "none";
            //         discapacidadContainer.style.display = "none";
            //     } else if (role === "profesor") {
            //         gradoContainer.style.display = "block";
            //         discapacidadContainer.style.display = "none";
            //         gradoLabel.textContent = "Asignar grado escolar:";
            //     } else {
            //         gradoContainer.style.display = "block";
            //         discapacidadContainer.style.display = "block";
            //         gradoLabel.textContent = "Selecciona tu grado:";
            //     }
            // }

            // roleSelect.addEventListener("change", actualizarFormulario);
            // actualizarFormulario();
        function actualizarFormulario() {
            let role = document.getElementById("role").value;
            let gradoContainer = document.getElementById("gradoContainer");
            let discapacidadContainer = document.getElementById("discapacidadContainer");

            if (role === "admin" || role === "evaluador_pedagogico") {
                gradoContainer.style.display = "none";
                discapacidadContainer.style.display = "none";
            } else if (role === "profesor") {
                gradoContainer.style.display = "block";
                discapacidadContainer.style.display = "none";
            } else {
                gradoContainer.style.display = "block";
                discapacidadContainer.style.display = "block";
            }
        }

        document.getElementById("role").addEventListener("change", actualizarFormulario);
        actualizarFormulario();

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrar Grados Escolares</title>
    <style>
        body { font-family: Arial, sans-serif; 
            background-color: #f9f9f9; 
            margin: 0; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            padding: 0px; 
        }


        .header { display: flex; 
            justify-content: space-between; 
            align-items: center; 
            background-color: #fff; 
            padding: 10px 20px; 
            width: 100%; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
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


        .container { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            width: 50%; 
            text-align: center; 
            margin-top: 20px; 
        }


        input, select { 
            width: 80%; 
            padding: 10px; 
            margin: 10px 0; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
        }


        button { 
            background-color: #007bff; 
            color: white; 
            padding: 10px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }


        button:hover { 
            background-color: #0056b3; 
        }


        .course-list { 
            margin-top: 20px; 
        }


        .course-item { 
            display: flex; 
            justify-content: space-between; 
            padding: 10px; 
            background: #f1f1f1; 
            margin-top: 5px; 
            border-radius: 5px; 
        }


        .delete-btn { 
            background-color: red;
            border: none; 
            color: white; 
            padding: 5px 10px; 
            cursor: pointer;
            border-radius: 5px; 
        }


        #formulario-profesor { 
            display: none; 
            margin-top: 20px; 
        }

        
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
    <div class="welcome"><h1>Grados Escolares</h1></div>
    <a href="{{ route('admin.administrador') }}">
        <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
    </a>
</div>

<div class="container">
    <h2>Crear Nuevo Grado Escolar</h2>
    <form id="form-grado" action="{{ route('grado.guardar') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre del grado" required>
        
        <select name="grado" required>
            <option value="">Seleccione nivel escolar</option>
            <option value="Transición">Educación Básica</option>
        </select>

        <input type="text" name="descripcion" placeholder="Descripción (opcional)">

        <!-- Mostrar el campo de selección solo si hay profesores disponibles -->
        @if(!$profesores->isEmpty())
            <select name="profesor_id" id="select-profesor" onchange="mostrarFormularioProfesor()">
                <option value="">Seleccione un profesor</option>
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                @endforeach
                <option value="nuevo">Crear nuevo profesor</option>
            </select>
        @else
            <p>No hay profesores disponibles. Complete el formulario a continuación para crear uno.</p>
        @endif

        <button type="submit">Guardar Grado</button>
    </form>
</div>

<!-- Formulario oculto para crear nuevo profesor -->
<div class="container" id="formulario-profesor">
    <h2>Crear Nuevo Profesor</h2>
    <form id="form-profesor" action="{{ route('profesor.guardar') }}" method="POST" onsubmit="unirFormularios(event)">
        @csrf
        <input type="text" name="nombre_profesor" placeholder="Nombre del profesor" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="text" name="telefono" placeholder="Número telefónico">
        <input type="text" name="usuario" placeholder="Usuario (número de documento)" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Guardar Profesor y Grado</button>
    </form>
</div>

<div class="container course-list">
    <h2>Grados Escolares Existentes</h2>
    @foreach($grados as $grado)
        <div class="course-item">
            <span>{{ $grado->nombre }} - {{ $grado->grado }} (Profesor: {{ $grado->profesor->nombre ?? 'No asignado' }})</span>
            <form action="{{ route('grado.eliminar', $grado->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Eliminar</button>
            </form>
        </div>
    @endforeach
</div>

<!-- Script para mostrar/ocultar el formulario de profesor y combinar formularios -->
<script>
    function mostrarFormularioProfesor() {
        const select = document.getElementById('select-profesor');
        const formulario = document.getElementById('formulario-profesor');

        if (select.value === 'nuevo') {
            formulario.style.display = 'block';
        } else {
            formulario.style.display = 'none';
        }
    }

    function unirFormularios(event) {
        event.preventDefault();
        const formGrado = document.getElementById('form-grado');
        const formProfesor = document.getElementById('form-profesor');

        // Crear un formulario combinado
        const formData = new FormData(formGrado);
        const formDataProfesor = new FormData(formProfesor);

        // Agregar datos del profesor al formulario de grado
        for (const [key, value] of formDataProfesor.entries()) {
            formData.append(key, value);
        }

        // Enviar formulario combinado
        fetch(formGrado.action, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => {
              alert('Grado y profesor creados exitosamente');
              window.location.reload();
          }).catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>

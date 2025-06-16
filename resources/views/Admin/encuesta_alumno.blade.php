<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Satisfacción</title>
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
        
        .logo {
            max-width: 80px;
        }

        .regresar {
            /* width: 27px; */
            width: auto;
            height: 27px;
            cursor: pointer;
            margin-right: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        .pregunta {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
        }

        .pregunta input {
            flex-grow: 1;
            padding: 6px 150px;
            margin-right: 10px;
        }

        .pregunta button {
            margin-left: 5px;
            padding: 6px 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .add-btn {
            padding: 8px;
            border-radius: 5px;
        }

        .submit-btn{
            padding: 8px;
            border-radius: 5px;

        }

        .delete-btn { 
            background-color: red; 
            color: white; 
        }
        
        .add-btn { 
            background-color: green; 
            color: white; 
        }

        .submit-btn { 
            background-color: blue; 
            color: white; 
        }
    
    
    </style>

</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome"><h1>Encuesta de Satisfacción</h1></div>
        <a href="{{ route('admin.administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>
    
    <div class="form-container">
        <h2>Preguntas...</h2>
        <form action="{{ route('admin.encuesta.guardar') }}" method="POST">
            @csrf
            <div id="preguntas-container">
                @for ($i = 1; $i <= 1; $i++)
                    <div class="pregunta" id="pregunta-{{ $i }}">
                        <input type="text" name="preguntas[]" placeholder="Nueva pregunta" required>
                        <button type="button" class="delete-btn" onclick="eliminarPregunta({{ $i }})">Eliminar</button>
                    </div>
                @endfor
            </div>
            <button type="button" class="add-btn" onclick="agregarPregunta()">Agregar Pregunta</button>
            <button type="submit" class="submit-btn">Guardar y Enviar</button>
        </form>
    </div>

    <script>
        let contadorPreguntas = 1;
        
        function eliminarPregunta(id) {
            const pregunta = document.getElementById(`pregunta-${id}`);
            if (pregunta) {
                pregunta.remove();
            }
        }
        
        function agregarPregunta() {
            contadorPreguntas++;
            const contenedor = document.getElementById('preguntas-container');
            const div = document.createElement('div');
            div.className = "pregunta";
            div.id = `pregunta-${contadorPreguntas}`;
            div.innerHTML = `
                <input type="text" name="preguntas[]" placeholder="Nueva pregunta" required>
                <button type="button" class="delete-btn" onclick="eliminarPregunta(${contadorPreguntas})">Eliminar</button>
            `;
            contenedor.appendChild(div);
        }
    </script>

</body>
</html>


{{-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Formulario Dinámico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .question {
            margin-bottom: 20px;
        }

        .option {
            margin-left: 20px;
        }

        .remove-btn {
            background-color: #f44336;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            margin-top: 10px;
        }

        .remove-btn:hover {
            background-color: #a51a17;
        }

        .add-btn, .save-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            margin-top: 10px;
        }

        .add-btn:hover, .save-btn:hover {
            background-color: #16823f;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Crear Formulario Dinámico</h2>
        <div id="formulario"></div>
        <button class="add-btn" onclick="agregarPregunta()">Agregar Pregunta</button>
        <button class="save-btn" onclick="guardarFormulario()">Guardar Formulario</button>
    </div>

    <script>
        let contadorPreguntas = 0;

        function agregarPregunta() {
            contadorPreguntas++;
            const formulario = document.getElementById('formulario');

            const preguntaDiv = document.createElement('div');
            preguntaDiv.classList.add('question');
            preguntaDiv.innerHTML = `
                <input type="text" name="pregunta${contadorPreguntas}" placeholder="Escribe la pregunta" required>
                <select onchange="cambiarTipoRespuesta(this, ${contadorPreguntas})">
                    <option value="texto">Respuesta de Texto</option>
                    <option value="opcion_multiple">Opción Múltiple</option>
                    <option value="numerica">Puntuación Numérica</option>
                </select>
                <div id="respuestas${contadorPreguntas}"></div>
                <button class="remove-btn" onclick="eliminarPregunta(this)">Eliminar Pregunta</button>
            `;
            formulario.appendChild(preguntaDiv);
        }

        function cambiarTipoRespuesta(select, id) {
            const contenedor = document.getElementById(`respuestas${id}`);
            contenedor.innerHTML = '';

            switch (select.value) {
                case 'texto':
                    contenedor.innerHTML = '<input type="text" placeholder="Respuesta de texto">';
                    break;

                case 'opcion_multiple':
                    contenedor.innerHTML = `
                        <div id="opciones${id}">
                            <input type="text" placeholder="Opción 1">
                        </div>
                        <button type="button" onclick="agregarOpcion(${id})">Agregar Opción</button>
                    `;
                    break;

                case 'numerica':
                    contenedor.innerHTML = '<input type="number" placeholder="Respuesta numérica">';
                    break;
            }
        }

        function agregarOpcion(id) {
            const opcionesDiv = document.getElementById(`opciones${id}`);
            const nuevaOpcion = document.createElement('input');
            nuevaOpcion.type = 'text';
            nuevaOpcion.placeholder = `Opción ${opcionesDiv.children.length + 1}`;
            opcionesDiv.appendChild(nuevaOpcion);
        }

        function eliminarPregunta(boton) {
            const preguntaDiv = boton.parentNode;
            preguntaDiv.remove();
        }

        function guardarFormulario() {
            alert('Formulario guardado exitosamente (Función por implementar)');
        }
    </script>

</body>

</html> --}}

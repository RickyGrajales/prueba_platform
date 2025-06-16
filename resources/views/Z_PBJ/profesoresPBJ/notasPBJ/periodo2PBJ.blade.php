<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodo2 P.B.J</title>
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
        
        .nav-header {
            height: 50px;
            padding: 20px 30px;
        }


        .logo {
            height: 80px;
            width: auto;
        }

        .regresar {
            height: 27px;
            /* width: 27px; */
            cursor: pointer;
            width: auto;
        }

        
        .form-materia{
            text-align: right;
            padding: 20px  30px;
        }


        .form-materia{
            font-weight: bold;
            margin-right: 10px;

        }

        select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #aaa;

        }

        h2 {
            margin-top: 10px;
            color: #1a1a1a;

        }
          
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 95%; /* Más ancho para aprovechar el espacio */
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;
        
        }

        th, td {
            padding: 8px 10px; /* Reducir un poco el padding para que no se vea tan grande */
            text-align: center;
            border-bottom: 1px solid #dddddd;
            font-size: 14px; /* Tamaño del texto reducido para mayor comodidad */
        
        }

        thead {
            background-color: #007BFF;
            color: rgb(0, 0, 0); /* Que los títulos sean más legibles */
        }

        tr:hover {
            background-color: #f1f1f1;
        
        }

        input[type="number"] {
            width: 50px; /* Reducir el ancho del input */
            padding: 4px;
            border-radius: 4px;
            border: 1px solid #bbb;
            text-align: center;
            font-size: 12px; /* Texto más pequeño */
        
        }

        td.promedio {
            font-weight: bold;
            color: #000000;
            font-size: 14px;
        
        }

        @media (max-width: 768px) { /* Quité el ; que tenías */
            table, thead, tbody, th, td, tr {
                display: block;
            
            }
            
            th {
                display: none;
            
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: left;
                font-size: 12px; /* Aseguramos que en móviles sea más pequeño */
            
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 10px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #555;
            
            }

            td:nth-child(1)::before { content: "Nombre"; color:#000000; }
            td:nth-child(2)::before { content: "Nota1"; }
            td:nth-child(3)::before { content: "Nota2"; }
            td:nth-child(4)::before { content: "Nota3"; }
            td:nth-child(5)::before { content: "Nota4"; }
            td:nth-child(6)::before { content: "Nota5"; } /* Corregido para que se ajuste a tus columnas */
            td:nth-child(7)::before { content: "Nota6"; }
            td:nth-child(8)::before { content: "Promedio";}

        }


        .button-env{
            background-color:#007BFF;  
            width: 100px;
            height: 42px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
           
        }

    </style>
</head>
<body>
    <header class="nav-header">
        <a href="#"><img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo" class="logo"></a>
        <h1>Periodo 2</h1>
        <a href="{{ route('profesorPBJ.inicio') }}"><img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar"></a>
    </header>

    {{-- FORMULARIO PARA CAMBIAR LA MATERIA --}}
    <form method="GET" action="{{ route('profesorPBJ.periodo2.mostrar') }}">
        <label for="materia">Seleccione una materia:</label>
        <select name="materia_id" id="materia" onchange="this.form.submit()">
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}" {{ $materia_id == $materia->id ? 'selected' : '' }}>
                    {{ $materia->nombre }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- FORMULARIO PARA GUARDAR NOTAS --}}
    <form action="{{ route('profesorPBJ.guardarPeriodo2') }}" method="POST">
        @csrf

        {{-- Ocultamos el materia_id que viene del formulario anterior --}}
        <input type="hidden" name="materia_id" value="{{ $materia_id }}">

        <h2 id="materiaSeleccionadaTitulo" style="color: #007BFF;"></h2>
        <h2>Estudiantes del grado: {{ $profesor->grado }}</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nota1</th>
                    <th>Nota2</th>
                    <th>Nota3</th>
                    <th>Nota4</th>
                    <th>Nota5</th>
                    <th>Nota6</th>
                    <th>Promedio</th>
                </tr>
            </thead>
            <tbody>
            @foreach($estudiantes as $estudiante)
                @php
                    $nota = $notas->get($estudiante->id);
                @endphp
                <tr>
                    <td>{{ $estudiante->nombre }}</td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota1]" min="0" max="5" step="0.1" value="{{ $nota->nota1 ?? '' }}"></td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota2]" min="0" max="5" step="0.1" value="{{ $nota->nota2 ?? '' }}"></td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota3]" min="0" max="5" step="0.1" value="{{ $nota->nota3 ?? '' }}"></td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota4]" min="0" max="5" step="0.1" value="{{ $nota->nota4 ?? '' }}"></td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota5]" min="0" max="5" step="0.1" value="{{ $nota->nota5 ?? '' }}"></td>
                    <td><input type="number" name="estudiantes[{{ $estudiante->id }}][nota6]" min="0" max="5" step="0.1" value="{{ $nota->nota6 ?? '' }}"></td>
                    <td class="promedio">{{$nota->promedio ??''}}</td> <!-- Aquí el promedio será calculado y puesto en vivo -->
                    <input type="hidden" name="estudiantes[{{ $estudiante->id }}][estudiante_id]" value="{{ $estudiante->id }}">
                </tr>
            @endforeach
            </tbody>
        </table>

        <button class="button-env" type="submit" style="padding: 10px 20px; font-size: 16px;">Guardar</button>
    </form>

    <h3>Docente: {{ $profesor->nombre }}</h3>

    <script>
        const selectMateria = document.getElementById('materia');
        const tituloMateria = document.getElementById('materiaSeleccionadaTitulo');
        window.addEventListener('DOMContentLoaded', () => {
            tituloMateria.textContent = "Materia seleccionada: " + selectMateria.options[selectMateria.selectedIndex].text;
        });
        selectMateria.addEventListener('change', function() {
            tituloMateria.textContent = "Materia seleccionada: " + this.options[this.selectedIndex].text;
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Al cargar la página calculamos los promedios con valores iniciales (si hay)
            calcularPromedios();

            // A cada input de nota le agregamos el evento 'input'
            document.querySelectorAll('tbody tr').forEach(fila => {
                // Solo inputs de notas (evitando inputs ocultos)
                const inputsNotas = fila.querySelectorAll('input[type="number"]');

                inputsNotas.forEach(input => {
                    input.addEventListener('input', () => {
                        // Al cambiar cualquiera de estos inputs, recalculamos promedio para esta fila
                        calcularPromedioFila(fila);
                    });
                });
            });
        });

        function calcularPromedios() {
            document.querySelectorAll('tbody tr').forEach(fila => {
                calcularPromedioFila(fila);
            });
        }

        function calcularPromedioFila(fila) {
            const inputs = fila.querySelectorAll('input[type="number"]');
            let suma = 0;
            let cantidad = 0;

            inputs.forEach(input => {
                const val = parseFloat(input.value);
                if (!isNaN(val) && val >= 0 && val <= 5) {
                    suma += val;
                    cantidad++;
                }
            });

            const promedio = cantidad > 0 ? (suma / cantidad).toFixed(1) : '';
            // Actualizamos la celda de promedio (debe existir en la fila)
            const celdaPromedio = fila.querySelector('.promedio');
            if (celdaPromedio) {
                celdaPromedio.textContent = promedio;
            }
        }
    </script>

</body>
</html>

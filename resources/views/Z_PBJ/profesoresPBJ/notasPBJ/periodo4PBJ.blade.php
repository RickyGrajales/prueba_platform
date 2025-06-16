<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Periodo 4 P.B.J</title>

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

        /* table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            border-radius: 10px;
            overflow: hidden;

        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;

        }

        thead {
            background-color: #007BFF;

        }

        tr:hover {
        background-color: #f1f1f1;

        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #bbb;
            text-align: center;
            font-size: 14px;
        }

        td.promedio {
            font-weight: bold;
            color: #000000;

        }

        @media (max-width: 768px;) {
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

              td:nth-child(1)::before { content: "Nombre"; }
            td:nth-child(2)::before { content: "Nota1"; }
            td:nth-child(3)::before { content: "Nota2"; }
            td:nth-child(4)::before { content: "Nota3"; }
            td:nth-child(5)::before { content: "Nota4"; }
            td:nth-child(6)::before { content: "Promedio"; }

        } */


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
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>Periodo 4.</h1>
        <a href="{{ route('profesorPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <form action="#" method="GET" class="form-materia">
    <label for="materia">Seleccione una materia:</label>
    <select name="materia" id="materia">
        @foreach($materias as $materia)
            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
        @endforeach
    </select>
    </form>
    
    <h2 id="materiaSeleccionadaTitulo" style="color: #007BFF; margin-top: 10px;"></h2>

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
                <tr>
                    <td>{{ $estudiante->nombre }}</td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td><input type="number" min="0" max="5" step="0.1" class="nota" oninput="calcularPromedio(this)"></td>
                    <td class="promedio"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
    <button class="button-env" type="submit" style="padding: 10px 20px; font-size: 16px;">Guardar</button>

    <script>

    function calcularPromedio(input) {
        const fila = input.closest('tr');
        const notas = fila.querySelectorAll('.nota');
        let suma = 0;
        let cantidadNotas = 0;

        notas.forEach(nota => {
            const valor = parseFloat(nota.value);
            if (!isNaN(valor) && valor >= 0 && valor <= 5) {
            suma += valor;
            cantidadNotas++;
            }
            });

        const promedioCell = fila.querySelector('.promedio');

        if (cantidadNotas > 0) {
            const promedio = (suma / cantidadNotas).toFixed(1);
            promedioCell.textContent = promedio;
        } else {
            promedioCell.textContent = '';
        }
    }
    </script>

    <h3>Docente {{ $profesor->nombre }}</h3>

        <script>
        const selectMateria = document.getElementById('materia');
        const tituloMateria = document.getElementById('materiaSeleccionadaTitulo');

        // Mostrar el nombre al cargar la página
        window.addEventListener('DOMContentLoaded', () => {
            const opcionInicial = selectMateria.options[selectMateria.selectedIndex].text;
            tituloMateria.textContent = "Materia seleccionada: " + opcionInicial;
        });

        // Actualizar título cuando se cambia la materia
        selectMateria.addEventListener('change', function() {
            const texto = this.options[this.selectedIndex].text;
            tituloMateria.textContent = "Materia seleccionada: " + texto;
        });
    </script>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta PBJ</title>
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
            width: auto;
            height: 27px;
            cursor: pointer;
            margin-right: 20px;
        }

        .welcome {
            font-size: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
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
            padding: 6px 120px;
            margin-right: 10px;
        }

        .pregunta button {
            margin-left: 5px;
            padding: 6px 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .add-btn,
        .submit-btn {
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
        <div class="welcome"><h1>Encuesta P.B.J</h1></div>
        <a href="{{ route('adminPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>

    <div class="form-container">
        <h2>Preguntas...</h2>
        <form action="{{ route('adminPBJ.encuesta.guardar') }}" method="POST">
            @csrf
            <div id="preguntas-container">
                @for ($i = 1; $i <= 1; $i++)
                    <div class="pregunta" id="pregunta-{{ $i }}">
                        <input type="text" name="preguntas[{{ $i }}][texto]" placeholder="Nueva pregunta" required>
                        <button type="button" class="delete-btn" onclick="eliminarPregunta({{ $i }})">Eliminar</button>
                    </div>
                @endfor
            </div>
            <button type="button" class="add-btn" onclick="agregarPregunta()">Agregar Pregunta</button>
            <button type="submit" class="submit-btn">Guardar y Enviar</button>
        
            <form action="{{ route('adminPBJ.encuesta.eliminarTodas') }}" method="POST" onsubmit="return confirmarEliminacion();">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Eliminar Todas</button>
            </form>
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
                <input type="text" name="preguntas[${contadorPreguntas}][texto]" placeholder="Nueva pregunta" required>
                <button type="button" class="delete-btn" onclick="eliminarPregunta(${contadorPreguntas})">Eliminar</button>
            `;
            contenedor.appendChild(div);
        }
    </script>
</body>
</html> --}}

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta PBJ</title>
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
            width: auto;
            height: 27px;
            cursor: pointer;
            margin-right: 20px;
        }

        .welcome {
            font-size: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
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
            padding: 6px 120px;
            margin-right: 10px;
        }

        .pregunta button {
            margin-left: 5px;
            padding: 6px 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .add-btn,
        .submit-btn,
        .delete-btn {
            padding: 8px;
            border-radius: 5px;
            min-width: 50px;
            text-align: center;
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

        .botones-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome"><h1>Encuesta P.B.J</h1></div>
        <a href="{{ route('adminPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>

    <div class="form-container">
        <h2>Preguntas...</h2>
        <form action="{{ route('adminPBJ.encuesta.guardar') }}" method="POST">
            @csrf
            <div id="preguntas-container">
                @for ($i = 1; $i <= 1; $i++)
                    <div class="pregunta" id="pregunta-{{ $i }}">
                        <input type="text" name="preguntas[{{ $i }}][texto]" placeholder="Nueva pregunta" required>
                        <button type="button" class="delete-btn" onclick="eliminarPregunta({{ $i }})">Eliminar</button>
                    </div>
                @endfor
            </div>

            
            <div class="botones-container">
                <button type="button" class="add-btn" onclick="agregarPregunta()">Agregar Pregunta</button>
                <button type="submit" class="submit-btn">Guardar y Enviar</button>
            </div>
            </form> <!-- Cierra el formulario principal -->
            
            <!-- Formulario separado para eliminar todas -->
            <form action="{{ route('adminPBJ.encuesta.eliminarTodas') }}" method="POST" onsubmit="return confirmarEliminacion();" style="margin-top: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Eliminar Todas</button>
            </form>
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
                <input type="text" name="preguntas[${contadorPreguntas}][texto]" placeholder="Nueva pregunta" required>
                <button type="button" class="delete-btn" onclick="eliminarPregunta(${contadorPreguntas})">Eliminar</button>
            `;
            contenedor.appendChild(div);
        }

        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar todas las preguntas?");
        }
    </script>
</body>
</html>

 --}}


 {{-- <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Encuesta PBJ</title>
     <style>
         body {
             font-family: Arial, sans-serif;
             background-color: #f9f9f9;
             margin: 0;
             padding: 0;
             display: flex;
             flex-direction: column;
             align-items: center;
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
             width: auto;
             height: 27px;
             cursor: pointer;
             margin-right: 20px;
         }
 
         .welcome {
             font-size: 20px;
         }
 
         .form-container {
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             width: 80%;
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
             padding: 6px 120px;
             margin-right: 10px;
         }
 
         .pregunta button {
             margin-left: 5px;
             padding: 6px 20px;
             cursor: pointer;
             border: none;
             border-radius: 5px;
         }
 
         .add-btn,
         .submit-btn,
         .delete-btn {
             padding: 8px;
             border-radius: 5px;
             min-width: 50px;
             text-align: center;
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
 
         .botones-container {
             display: flex;
             gap: 10px;
             margin-top: 15px;
             justify-content: flex-start;
             flex-wrap: nowrap;
             align-items: center;
         }
 
         .botones-container form {
             margin: 0;
         }
     </style>
 </head>
 <body>
     <div class="header">
         <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
         <div class="welcome"><h1>Encuesta P.B.J</h1></div>
         <a href="{{ route('adminPBJ.inicio') }}">
             <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
         </a>
     </div>
 
     <div class="form-container">
         <h2>Preguntas...</h2>
         <form action="{{ route('adminPBJ.encuesta.guardar') }}" method="POST">
             @csrf
             <div id="preguntas-container">
                 @for ($i = 1; $i <= 1; $i++)
                     <div class="pregunta" id="pregunta-{{ $i }}">
                         <input type="text" name="preguntas[{{ $i }}][texto]" placeholder="Nueva pregunta" required>
                         <button type="button" class="delete-btn" onclick="eliminarPregunta({{ $i }})">Eliminar</button>
                     </div>
                 @endfor
             </div>
 
             <div class="botones-container">
                 <button type="button" class="add-btn" onclick="agregarPregunta()">Agregar</button>
                 <button type="submit" class="submit-btn">Enviar</button>
 
                 <!-- Botón Eliminar Todas dentro del mismo contenedor -->
                 <form action="{{ route('adminPBJ.encuesta.eliminarTodas') }}" method="POST" onsubmit="return confirmarEliminacion();">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="delete-btn">Eliminar Todas</button>
                 </form>
             </div>
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
                 <input type="text" name="preguntas[${contadorPreguntas}][texto]" placeholder="Nueva pregunta" required>
                 <button type="button" class="delete-btn" onclick="eliminarPregunta(${contadorPreguntas})">Eliminar</button>
             `;
             contenedor.appendChild(div);
         }
 
         function confirmarEliminacion() {
             return confirm("¿Estás seguro de que deseas eliminar todas las preguntas?");
         }
     </script>
 </body>
 </html>
  --}}


  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Encuesta PBJ</title>
      <style>
          body {
              font-family: Arial, sans-serif;
              background-color: #f9f9f9;
              margin: 0;
              padding: 0;
              display: flex;
              flex-direction: column;
              align-items: center;
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
              width: auto;
              height: 27px;
              cursor: pointer;
              margin-right: 20px;
          }
  
          .welcome {
              font-size: 20px;
          }
  
          .form-container {
              display: flex;
              flex-direction: column;
              align-items: center;
              justify-content: center;
              width: 80%;
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
              padding: 6px 120px;
              margin-right: 10px;
          }
  
          .pregunta button {
              margin-left: 5px;
              padding: 6px 20px;
              cursor: pointer;
              border: none;
              border-radius: 5px;
          }
  
          .add-btn,
          .submit-btn,
          .delete-btn {
              padding: 8px;
              border-radius: 5px;
              min-width: 50px;
              text-align: center;
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
  
          .acciones-container {
              display: flex;
              gap: 10px;
              margin-top: 15px;
              justify-content: flex-start;
              flex-wrap: nowrap;
          }
      </style>
  </head>
  <body>
      <div class="header">
          <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
          <div class="welcome"><h1>Encuesta P.B.J</h1></div>
          <a href="{{ route('adminPBJ.inicio') }}">
              <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
          </a>
      </div>
  
      <div class="form-container">
          <h2>Preguntas...</h2>
  
          <!-- Formulario principal -->
          <form action="{{ route('adminPBJ.encuesta.guardar') }}" method="POST">
              @csrf
              <div id="preguntas-container">
                  @for ($i = 1; $i <= 1; $i++)
                      <div class="pregunta" id="pregunta-{{ $i }}">
                          <input type="text" name="preguntas[{{ $i }}][texto]" placeholder="Nueva pregunta" required>
                          <button type="button" class="delete-btn" onclick="eliminarPregunta({{ $i }})">Eliminar</button>
                      </div>
                  @endfor
              </div>
  
              <!-- Botones Agregar y Enviar -->
              <div class="acciones-container">
                  <button type="button" class="add-btn" onclick="agregarPregunta()">Agregar</button>
                  <button type="submit" class="submit-btn">Enviar</button>
              </div>
          </form>
  
          <!-- Botón Eliminar Todas (fuera del form principal) -->
          <form action="{{ route('adminPBJ.encuesta.eliminarTodas') }}" method="POST" onsubmit="return confirmarEliminacion();">
              @csrf
              @method('DELETE')
              <div class="acciones-container">
                  <button type="submit" class="delete-btn">Eliminar Todas</button>
              </div>
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
                  <input type="text" name="preguntas[${contadorPreguntas}][texto]" placeholder="Nueva pregunta" required>
                  <button type="button" class="delete-btn" onclick="eliminarPregunta(${contadorPreguntas})">Eliminar</button>
              `;
              contenedor.appendChild(div);
          }
  
          function confirmarEliminacion() {
              return confirm("¿Estás seguro de que deseas eliminar todas las preguntas?");
          }
      </script>
  </body>
  </html>
  
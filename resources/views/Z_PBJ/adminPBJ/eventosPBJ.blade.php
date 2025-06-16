{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos P.B.J</title>
    
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
        .welcome {
            font-size: 20px;

        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        <div class="welcome"><h1>Eventos P.B.J</h1></div>
        <a href="{{ route('adminPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos P.B.J</title>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>

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
        .header{
            height: 75px;
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

        .contenedor-principal {
            width: 40%;
            margin-top: 60px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .form-container input, .form-container textarea {
            width: 96%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .guardar-btn {
            background-color: green;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .eliminar-btn {
            background-color: red;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #calendar {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 94%;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
    <div class="welcome"><h1>Eventos P.B.J</h1></div>
    <a href="{{ route('adminPBJ.inicio') }}">
        <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
    </a>
</div>

<div class="contenedor-principal">
      {{-- Mensaje de éxito --}}
      @if(session('success'))
      <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
          {{ session('success') }}
      </div>
  @endif

  <div class="form-container">
    <div class="form-container">
        <h2>Nuevo Evento</h2>

        <form action="{{ route('eventosPBJ.store') }}" method="POST">
            @csrf
            <input type="text" name="titulo" placeholder="Título del evento" required>
            <textarea name="descripcion" placeholder="Descripción del evento" required></textarea>
            <input type="date" name="fecha" required>
            <div class="btn-group">
                <button type="submit" class="guardar-btn">Crear Evento</button>
        </form>

        <form action="{{ route('eventosPBJ.destroyAll') }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar todos los eventos?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="eliminar-btn">Eliminar Todos</button>
        </form>
    </div>

    {{-- <h2>Calendario de Eventos</h2>
    <div id="calendar"></div> --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            events: [
                @foreach($eventos as $evento)
                {
                    title: '{{ $evento->titulo }}',
                    start: '{{ $evento->fecha }}',
                    description: '{{ $evento->descripcion }}',
                },
                @endforeach
            ],
            eventClick: function(info) {
                alert('Evento: ' + info.event.title + "\nDescripción: " + info.event.extendedProps.description);
            }
        });

        calendar.render();
    });
</script>

</body>
</html>

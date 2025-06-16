<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Eventos</title>
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

    .logo {
        height: 80px;
        width: auto;
    }

    .regresar {
        height: 27px;
        width: auto;
        cursor: pointer;
    }

    .contenedor-principal {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
    }

    .form-container {
        width: 500px;
        height: 330px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .form-container h2 {
        margin-bottom: 10px;
    }

    .form-container input,
    .form-container textarea {
        width: 90%;
        margin-bottom: 10px;
        padding: 8px;
    }

    .form-container .btn-group {
        display: flex;
        justify-content: center; /* Centrar botones */
        gap: 10px; /* Espacio entre botones reducido */
    }

    .form-container button {
        /* border: none; */
        cursor: pointer;
        height: 40px;
        width: 140px; /* Ancho ajustado para que estén más juntos */
        margin-top: 10px;
    }

    .guardar-btn {
        background-color: #4CAF50;
        color: #fff;
    }

    .guardar-btn:hover {
        background-color: #16823f;
    }

    .eliminar-btn {
        background-color: #f44336;
        color: #fff;
    }

    .eliminar-btn:hover {
        background-color: #a51a17;
    }

    .calendario-container {
        width: 500px;
        height: 330px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    #calendario {
        width: 100%;
        height: 100%;
    }

    </style>
</head>

<body>

    <header class="nav-header">
        <a href="#">
            <img src="{{ asset('img/LogoFun.jpeg') }}" alt="Logo de la Fundación" class="logo">
        </a>
        <h1>Crear Eventos</h1>
        <a href="{{ url('admin/administrador') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </header>

    <div class="contenedor-principal">
        <div class="form-container">
            <h2>Nuevo Evento</h2>
            <form id="form-evento">
                @csrf
                <input type="text" name="titulo" placeholder="Título del evento" required>
                <textarea name="descripcion" placeholder="Descripción del evento" required></textarea>
                <input type="date" name="fecha" required>
                <div class="btn-group">
                    <button type="submit" class="guardar-btn">Guardar Evento</button>
                    <button id="eliminar-eventos" class="eliminar-btn">Eliminar Eventos</button>
                </div>
            </form>
        </div>

        <div class="calendario-container">
            <div id="calendario"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/locales/es.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarioEl = document.getElementById('calendario');
            const calendario = new FullCalendar.Calendar(calendarioEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                events: "{{ route('estudiantes.eventos') }}",
            });
            calendario.render();
    
            document.getElementById('form-evento').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("{{ route('admin.eventos.store') }}", {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error al guardar el evento');
                        }
                    });
            });
    
            // Botón para eliminar eventos
            document.getElementById('eliminar-eventos').addEventListener('click', function () {
                if (confirm("¿Estás seguro de que deseas eliminar todos los eventos?")) {
                    fetch("{{ route('admin.eventos.eliminar') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.mensaje) {
                                calendario.getEvents().forEach(event => event.remove());
                                alert(data.mensaje);
                                location.reload(); // Recargar la página para actualizar la vista
                            } else {
                                alert("Error al eliminar los eventos.");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
    

</body>

</html>

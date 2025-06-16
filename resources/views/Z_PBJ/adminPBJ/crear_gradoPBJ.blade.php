<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>P.B.J</title>

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
        <div class="welcome"><h1>Crear Grado P.B.J</h1></div>
        <a href="{{ route('adminPBJ.inicio') }}">
            <img src="{{ asset('img/regresar.png') }}" alt="Regresar" class="regresar">
        </a>
    </div>
    
</body>
</html>
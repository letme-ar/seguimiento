<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Oxygen Confirm</title>

    <style type="text/css">
        .container {
            width: 100%;
            height: 40px;
            background-color: #e5e5e5;
            border-radius: 15px;
            text-align: center;
            vertical-align: middle;
        }

        h3{
            font: 18px bold;
            line-height: 40px;
        }


    </style>
</head>

<body bgcolor="#f7f7f7">
    <div class="container">
        <h3>{{ ENV('SYSTEM_NAME') }}</h3>
    </div>
    @if($user->wasRecentlyCreated)
    <p>
        Hola, bienvenido al {{ strtolower(ENV('SYSTEM_NAME')) }}. Puede conectarse haciendo click <a href="{{ $url }}">Aqui</a>.
        Sus datos para iniciar sesión son los siguientes:
    </p>
    <p>
        Usuario: <strong>{{ $user->email }}</strong>
    </p>
    <p>
        Password: <strong>{{ $user->docente->legajo }}</strong>
    </p>
    @elseif($user->status)
        <p>
            Hola, bienvenido nuevamente al {{ strtolower(ENV('SYSTEM_NAME')) }}. Puede conectarse haciendo click <a href="{{ $url }}">Aqui</a>.
        </p>
    @else
        <p>
            Hola, su usuario ha sido desactivado del {{ strtolower(ENV('SYSTEM_NAME')) }}. Por favor contáctese con el administrador para poder continuar operando.
        </p>

    @endif

    <p>
        Gracias por utilizar el {{ strtolower(ENV('SYSTEM_NAME')) }}
    </p>
    <div class="container">
        <h3>Letme</h3>
    </div>

</body>
</html>
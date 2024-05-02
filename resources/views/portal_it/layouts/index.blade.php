<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- jQuery (obligatorio para los complementos de JavaScript de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js (obligatorio para los complementos de JavaScript de Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            max-width: 400px;
            position: relative;
            border-radius: 5px;
            overflow: hidden;
            color: white;
            box-shadow: 1.5px 1.5px 3px #0e0e0e, -1.5px -1.5px 3px rgb(95 94 94 / 25%), inset 0px 0px 0px #0e0e0e, inset 0px -0px 0px #5f5e5e;
            }

            .container .slider {
            width: 200%;
            position: relative;
            transition: transform ease-out 0.3s;
            display: flex;
            max-height: 550px;
            }

            #register_toggle {
            display: none;
            }

            .container #register_toggle:checked + .slider {
            transform: translateX(-50%);
            }

            .form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 30px;
            padding: 1.5em 3em;
            width: 50%;
            
            }

            .title {
            text-align: center;
            font-weight: 700;
            font-size: 2em;
            }

            form .form_control {
            width: 100%;
            position: relative;
            overflow: hidden;
            }

            form .form_control .label {
            position: absolute;
            top: 50%;
            left: 10px;
            transition: transform ease 0.2s;
            transform: translate(0%, -50%);
            font-size: 0.75em;
            user-select: none;
            pointer-events: none;
            color: #b0b0b0;
            }

            form .form_control .input {
            width: 100%;
            background-color: transparent;
            border: none;
            outline: none;
            color: #fff;
            padding: 0.5rem;
            font-size: 0.75rem;
            border-radius: 5px;
            transition: box-shadow ease 0.2s;
            box-shadow: 0px 0px 0px #0e0e0e, 0px 0px 0px rgb(95 94 94 / 25%), inset 1.5px 1.5px 3px #0e0e0e, inset -1.5px -1.5px 3px #5f5e5e;
            }

            form .form_control .input:focus,
            form .form_control .input:valid {
            box-shadow: 0px 0px 0px #0e0e0e, 0px 0px 0px rgb(95 94 94 / 25%), inset 3px 3px 4px #0e0e0e, inset -3px -3px 4px #5f5e5e;
            }

            form .form_control .input:focus + .label,
            form .form_control .input:valid + .label {
            transform: translate(-150%, -50%);
            }

            form button {
            width: 100%;
            background-color: transparent;
            border: none;
            outline: none;
            color: #fff;
            padding: 0.5rem;
            font-size: 0.75rem;
            border-radius: 5px;
            transition: box-shadow ease 0.1s;
            box-shadow: 1.5px 1.5px 3px #0e0e0e, -1.5px -1.5px 3px rgb(95 94 94 / 25%), inset 0px 0px 0px #0e0e0e, inset 0px -0px 0px #5f5e5e;
            }

            form button:active {
            box-shadow: 0px 0px 0px #0e0e0e, 0px 0px 0px rgb(95 94 94 / 25%), inset 3px 3px 4px #0e0e0e, inset -3px -3px 4px #5f5e5e;
            }

            .bottom_text {
            font-size: 0.65em;
            }

            .bottom_text .swtich {
            font-weight: 700;
            cursor: pointer;
            
            }
    </style>

    <title>Portal IT</title>
</head>
<body class="bg-dark text-white">
    <h1 style="text-align:center; margin-top:10px;">Bienvedido al Portal IT de Cedisur</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
            <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>
            </strong>Error al iniciar sesión verificar: <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <input type="checkbox" id="register_toggle" >
        <div class="slider">
            <form class="form" method="POST" action="{{ route('login') }}">
            @csrf
            <span class="title">Iniciar Sesión</span>
            <div class="form_control">
                <input id="email" name="email" type="text" class="input" >
                <label class="label">Email</label>
            </div>
            <div class="form_control">
                <input id="password" name="password" type="password" class="input">
                <label class="label">Contraseña</label>
            </div>
            <button>Iniciar</button>

            <span class="bottom_text">No tienes cuenta?<label for="register_toggle" class="swtich">Creala</label> </span>
            </form>
            <form class="form" method="POST" action="{{ route('register') }}" >
            @csrf
            <span class="title">Crear Cuenta</span>
            <div class="form_control">
                <input name="name" id="name" type="text" class="input" required="">
                <label class="label">Nombre y Apellido</label>
            </div>
            <div class="form_control">
                <input id="email" name="email" type="email" class="input" required="">
                <label class="label">Email</label>
            </div>
            <div class="form_control">
                <input id="password" name="password" type="password" class="input" required="">
                <label class="label">Contraseña</label>
            </div>
            <div class="form_control">
                <input id="password_confirmation" name="password_confirmation" type="password" class="input" required="">
                <label class="label">Confirmar Contraseña</label>
            </div>
            <div class="form_control">
            <select id="gerencia" name="gerencia" class="input">
                @foreach ($gerencias as $gerencia)
                    <option value="{{ $gerencia->nombre_gerencia }}">{{ $gerencia->nombre_gerencia }}</option>
                @endforeach
            </select>
            </div>
            <div class="form_control">
                <select id="puesto" name="puesto" class="input" id="puesto">
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->name_puesto }}">{{ $puesto->name_puesto }}</option>
                    @endforeach
                </select>
            </div>
            <button>Crear Cuenta</button>
            <span class="bottom_text">Ya tenes cuenta? <label for="register_toggle" class="swtich">Inicia Sesión</label> </span>
            </form>
            </div>
        </div>
</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @php
    use Illuminate\Support\Facades\Auth;
    @endphp
    <title>Portal IT</title>
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homeportal') }}">
            <svg style="width: 22px; height: 20px; color: azure; margin-left: 15px;" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
            </svg>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownConfig" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Configuración del Portal
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownConfig" style="border-color: white;">
                        <a class="dropdown-item text-white" href="{{ route('usuarios') }}">Usuarios</a>
                        <a class="dropdown-item text-white" href="{{ route('parametros') }}">Parámetros del Portal</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownTickets" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tickets
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownTickets" style="border-color: white;">
                        <a class="dropdown-item text-white" href="{{ route('nuevoticket') }}">Nuevo Ticket</a>
                        <a class="dropdown-item text-white" href="{{ route('ticketspendientes') }}">Tickets Pendientes</a>
                        <a class="dropdown-item text-white" href="{{ route('totaltickets') }}">Total de Tickets</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownComodatos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Comodatos
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownComodatos" style="border-color: white;">
                        <a class="dropdown-item text-white" href="#">Nuevo Comodato</a>
                        <a class="dropdown-item text-white" href="{{ route('comodato.index') }}">Total de Comodatos</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownInventario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Inventario
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownInventario" style="border-color: white;">
                        <a class="dropdown-item text-white" href="{{ route('recurso.create') }}">Nuevo Insumo</a>
                        <a class="dropdown-item text-white" href="{{ route('recurso.index') }}">Parque Total de Insumos</a>
                    </div>
                </li>
                <li class="nav-item dropdown ms-auto" style="position: absolute; right: 0;">
                    <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownUser" style="border-color: white;">
                        <a class="dropdown-item text-white" href="{{ route('profile.edit') }}">Editar Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>
    var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
    var warningTime = 2 * 60 * 1000; // 2 minutos de inactividad
    var logoutTime = 15 * 1000; // 15 segundos después de la advertencia
    var warningTimeout;
    var logoutTimeout;

    function showSessionTimeoutWarning() {
        return confirm("Tu sesión está a punto de expirar. ¿Quieres continuar?");
    }

    function logoutUser() {
        document.getElementById('logout-form').submit();
    }

    function startWarningTimer() {
        warningTimeout = setTimeout(function() {
            if (showSessionTimeoutWarning()) {
                fetch('/keep-alive').then(response => {
                    if (!response.ok) {
                        logoutUser();
                    } else {
                        startWarningTimer();
                    }
                });
            } else {
                logoutUser();
            }
        }, warningTime);
    }

    function resetInactivityTimer() {
        clearTimeout(warningTimeout);
        clearTimeout(logoutTimeout);
        startWarningTimer();
    }

    if (isAuthenticated) {
        window.onload = resetInactivityTimer;
        document.onmousemove = resetInactivityTimer;
        document.onkeypress = resetInactivityTimer;
    }
</script>
</body>
</html>

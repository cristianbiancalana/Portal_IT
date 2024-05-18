<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Portal IT</title>
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark" >
<div class="container-fluid">
  <a class="navbar-brand" href="{{route('homeportal')}}">
    <svg style="width: 22px; height: 20px; color:azure; margin-left:15px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
    </svg></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav me-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Configuración del Portal
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
            <a class="dropdown-item text-white" href="{{route('usuarios')}}">Usuarios</a>
            <a class="dropdown-item text-white" href="{{route('parametros')}}">Parametros del Portal</a>
          </div>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Tickets
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="{{route('nuevoticket')}}">Nuevo Ticket</a>
          <a class="dropdown-item text-white" href="{{route('ticketspendientes')}}">Tickets Pendientes</a>
          <a class="dropdown-item text-white" href="{{route('totaltickets')}}">Total de Tickets</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Comodatos
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="#">Nuevo Comodato</a>
          <a class="dropdown-item text-white" href="#">Anular Comodato</a>
          <a class="dropdown-item text-white" href="#">Total de Comodatos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Inventario
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="#">Nuevo Insumo</a>
          <a class="dropdown-item text-white" href="#">Editar Insumo</a>
          <a class="dropdown-item text-white" href="#">Parque Total de Insumos</a>
        </div>
      </li>
      <li class="nav-item dropdown" style="position: absolute; right: 0;">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	{{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
        <form method="GET" action="{{ route('profile.edit')}}">
                    @csrf
          <a class="dropdown-item text-white" href="route('logout')"onclick="event.preventDefault();this.closest('form').submit();">
          Editar Perfil
          </a>
          </form> 
          <form method="POST" action="{{ route('logout')}}">
                    @csrf
          <a class="dropdown-item text-white" href="route('logout')"onclick="event.preventDefault();this.closest('form').submit();">
          Cerrar sesion
          </a>
          </form>                              
        </div>
      </li>
    </ul>
  </div>
</nav>
    <div class="container">
        @yield('content')
    </div>
    <script>
        // Tiempo de vida de la sesión en minutos
        var sessionLifetime = {{ config('session.lifetime') }};
        // Tiempo de advertencia antes de que expire la sesión en minutos
        var warningTime = 1; // Ajusta este valor según sea necesario
        // Tiempo de espera antes de cerrar la sesión automáticamente en milisegundos
        var autoLogoutTime = 15000; // 15 segundos

        // Función para mostrar el aviso de cierre de sesión
        function showSessionTimeoutWarning() {
            var shouldStayLoggedIn = confirm("Tu sesión está a punto de expirar. ¿Quieres continuar?");
            if (shouldStayLoggedIn) {
                // Realizar una solicitud a una ruta para mantener la sesión activa
                fetch('{{ route('keep-alive') }}').then(response => {
                    if (response.ok) {
                        // Reiniciar el temporizador
                        startSessionTimer();
                    }
                });
            } else {
                // Redirigir a la página principal
                window.location.href = '{{ route('home') }}';
            }
        }

        // Función para cerrar la sesión automáticamente
        function autoLogout() {
            // Redirigir a la página de cierre de sesión
            window.location.href = '{{ route('logout') }}';
        }

        // Función para iniciar el temporizador de sesión
        function startSessionTimer() {
            // Mostrar la advertencia de tiempo de sesión
            setTimeout(showSessionTimeoutWarning, (sessionLifetime - warningTime) * 60 * 1000);

            // Cerrar sesión automáticamente después de 15 segundos si no se toma ninguna acción
            setTimeout(autoLogout, (sessionLifetime - warningTime) * 60 * 1000 + autoLogoutTime);
        }

        // Iniciar el temporizador al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            if (isAuthenticated) {
                startSessionTimer();
            }
        });
    </script>
</body>
</html>
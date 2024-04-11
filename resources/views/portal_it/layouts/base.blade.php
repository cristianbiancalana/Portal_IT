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


    <title>Portal IT</title>
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark" >
  <a class="navbar-brand" href="{{route('homeportal')}}">
    <svg style="width: 22px; height: 20px; color:azure; margin-left:15px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
    </svg></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configuración del Portal
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
            <a class="dropdown-item text-white" href="{{route('usuarios')}}">Usuarios</a>
            <a class="dropdown-item text-white" href="{{route('parametros')}}">Parametros del Portal</a>
          </div>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tickets
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="{{route('nuevoticket')}}">Nuevo Ticket</a>
          <a class="dropdown-item text-white" href="{{route('ticketspendientes')}}">Tickets Pendientes</a>
          <a class="dropdown-item text-white" href="{{route('totaltickets')}}">Total de Tickets</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Comodatos
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="#">Nuevo Comodato</a>
          <a class="dropdown-item text-white" href="#">Anular Comodato</a>
          <a class="dropdown-item text-white" href="#">Total de Comodatos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventario
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="#">Nuevo Insumo</a>
          <a class="dropdown-item text-white" href="#">Editar Insumo</a>
          <a class="dropdown-item text-white" href="#">Parque Total de Insumos</a>
        </div>
      </li>
      <li class="nav-item dropdown" style="position: absolute; right: 0;">
        <a class="nav-link dropdown-toggle bg-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	{{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink" style="border-color: white;">
          <a class="dropdown-item text-white" href="#">Editar Perfil</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
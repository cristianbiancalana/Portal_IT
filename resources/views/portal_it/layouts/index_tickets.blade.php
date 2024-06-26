@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">Total de Tickets</h2>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error al editar el ticket, verificar: <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error: {{ session('error') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
            <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"></path>
            </svg>{{ session('status') }}
            </div>
        @endif
        
        <div  style="display: flex; flex-direction:row;">
            <form method="GET" action="{{ route('totaltickets') }}">
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar..." class="form-control" style="width:200px; height:30px;">
                <button type="submit" class="btn btn-primary" style="width:95px; height:30px; margin-left:210px; margin-top:-59px; padding:2px;">Buscar</button>
            </form>
        </div>

        

        <div class="col-6 mt-2">
            <div style="max-width: 1500px; margin: 0 0 20px 0; ">
                <table class="table table-sm table-dark table-hover" style="text-align:center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <thead>
                        <tr>
                            <th>ID Ticket | 
                                <a href="{{ route('totaltickets', ['search' => request('search'), 'order' => 'id_asc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="m12 6.879-7.061 7.06 2.122 2.122L12 11.121l4.939 4.94 2.122-2.122z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('totaltickets', ['search' => request('search'), 'order' => 'id_desc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path>
                                    </svg>
                                </a>
                            </th>
                            <th>Prioridad | 
                                <a href="{{ route('totaltickets', ['search' => request('search'),  'order' => 'priority_asc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="m12 6.879-7.061 7.06 2.122 2.122L12 11.121l4.939 4.94 2.122-2.122z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('totaltickets', ['search' => request('search'),  'order' => 'priority_desc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                        <path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path>
                                    </svg>
                                </a>
                            </th>
                            <th>Asunto</th>
                            <th>Fecha</th>
                            <th>Solicitante</th>
                            <th>Gerencia</th>
                            <th>Estado</th>
                            <th>Técnico Asignado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            <th scope="row">{{$ticket->id}}</th>
                            <td>{{ $ticket->prioridad }}</td>
                            <td>{{ Illuminate\Support\Str::limit($ticket->asunto_ticket, 30) }}</td>
                            <td>{{$ticket->created_at->format('j/m/Y') }}</td>
                            <td>{{$ticket->user->name}}</td>
                            <td>{{$ticket->gerencia}}</td>
                            <td>{{$ticket->estado}}</td>
                            <td>{{$ticket->tecnico}}</td>
                            <td style="width:100px; height: 20px; ">
                                <a href="{{route('tickets.edit',$ticket)}}" style="color:azure;">
                                <svg style="width: 22px; height: 20px; margin-left:10px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                                </svg>
                                </a>
                                <a href="{{route('viewticket',$ticket)}}" style="color:azure;">
                                <svg style="width: 22px; height: 20px; margin-left:10px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"></path>
                                </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$tickets->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

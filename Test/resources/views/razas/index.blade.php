@extends('layouts.plantilla')
@section('title', 'home')
@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Bienvenido a la sección de las Razas</h1>
        <div style="width: 100%">
             <a class="btn btn-success btn-lg btn-block" style="width: 100%" href="razas/create">Ingresar Raza</a> 
        </div>
        <div id="respuesta">

        </div>
        <div class="list-group">
            @foreach ($razas as $raza)
                <li class="list-group-item mt-3" style="width: 100%">
                    <div class="row">
                        <div class="col">
                            <h5 class="lead">{{ $raza->nombreRaza }}</h5>
                            <span class="lead">Ingresado en: {{ $raza->created_at }}</span>
                        </div>
                        <a class="btn btn-warning btn-lg float-right"  style="width: 20%" href="{{ route('razas.edit', $raza) }}">Modificar</a>
                    </div>
                </li>
            @endforeach
        </div>
    </div>

    <script>
        const formulario = document.getElementById('formulario');
        formulario.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('click')
        })


    </script>

@endsection()

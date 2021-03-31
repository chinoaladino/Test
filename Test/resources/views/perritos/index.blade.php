@extends('layouts.plantilla')
@section('title', 'home')
@section('content')

    <div class="container-fluid">
        <h1 class="text-center">Bienvenido a la sección de los Perros </h1>
        <div style="width: 100%">
            <a class="btn btn-success btn-lg btn-block" style="width: 100%" href="perritos/create">Ingresar Perro</a>
        </div>
        <table class="table mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Color</th>
                    <th scope="col">Raza</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perritos as $perrito)
                    <tr>
                        <td>{{ $perrito->id }}</th>
                        <td><a href="{{route('perritos.show',$perrito)}}">{{ $perrito->nombre }}</a></td>
                        <td>{{ $perrito->color }}</td>
                        <td>{{ $perrito->nombreRaza }}</td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-warning float-right" href="{{ route('perritos.edit', $perrito->id) }}">Modificar</a>
                                </div>
                                <div class="col-2">
                                    /
                                </div>
                                <div class="col">
                                    <form id="formulario" method="POST" action="{{ route('perritos.delete', $perrito->id)}}">  
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger float-right" >Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection()

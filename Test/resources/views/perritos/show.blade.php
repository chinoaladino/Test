@extends('layouts.plantilla')
@section('title', $perritos->nombre)
@section('content')

    <a href="{{ route('perritos.index') }}" class="btn btn-primary">Volver</a>
    <div class="card mt-3">
        <img src="https://i.picsum.photos/id/237/700/300.jpg?hmac=nwl9-NpLONi86qZg4b75tw4CeBsdEMNcS_VuWQhq6a4"
            class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $perritos->nombre }}</h5>
            <p class="card-text">Color: {{ $perritos->color }}</p>
            <p class="card-text">Raza: {{ $perritos->nombreRaza }}</p>
            <p class="card-text"><small class="text-muted">Ingresado en: {{ $perritos->created_at }}</small></p>
        </div>
    </div>
@endsection()

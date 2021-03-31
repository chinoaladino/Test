@extends('layouts.plantilla')
@section('title', 'Raza' . $raza->nombreRaza)
@section('content')
    <div class="container">
        <div class="card">
            <img class="card-img-top" src="https://i.picsum.photos/id/237/500/300.jpg?hmac=31zB7Ceyovr2h1qoOGeI6Pg8iB8wDymSCLEasQlnHIE" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{ $raza->nombreRaza }}</h5>
              <p class="card-text">{{ $raza->created_at }}</p>
              <a href="{{route('razas.edit',$raza)}}" class="btn btn-warning">Modificar</a>
              <a href="#" class="btn btn-danger">Eliminar</a>
            </div>
          </div>
    </div>
@endsection()

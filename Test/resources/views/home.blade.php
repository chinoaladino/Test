@extends('layouts.plantilla')
@section('title', 'home')
@section('content')
<div class="container mt-4">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Bienvenido a la aplicacion de gestion de Perros:</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="display-2 text-center">
                            Seccion de Perros
                        </h2>
                        <a class="btn btn-primary btn-lg" style="width: 100%" href="/perritos">Revisar perros</a>
                    </div>
                    <div class="col-sm-6">
                        <h2 class="display-2 text-center">
                            Seccion de Razas
                        </h2>
                        <a class="btn btn-info btn-lg"  style="width: 100%" href="/razas">Revisar razas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
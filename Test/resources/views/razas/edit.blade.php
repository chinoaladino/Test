@extends('layouts.plantilla')
@section('title', 'Edit raza')
@section('content')
    <div class="container mt-5">
        <div class="justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Formulario para modificar la raza:</h2>
                        <p id="titulo-raza" class="text-center">{{ $razas->nombreRaza }}</p>
                    </div>
                    <div class="card-body">
                        <label class="col-sm col-form-label" for="exampleFormControlInput1">Nombre de la raza</label>
                        <div class="col-sm-10">
                            <form id="formulario" action="{{ route('razas.update', $razas->id)}}" method="POST">     
                                @csrf
                                <div id="respuesta">
                                </div>
                                <input type="text" id="nombre-raza" class="form-control is-invalid" name="nombreRaza"
                                    value="{{ $razas->nombreRaza }}" placeholder="{{ $razas->nombreRaza }}">
                                <div class="invalid-feedback">
                                    El nombre debe ser valido y entre 1-40 caracteres
                                </div>
                                <button type="submit" class="btn btn-warning btn-block mt-2" style="width: 100%">
                                    Modificar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const formulario = document.getElementById('formulario');
        const inputs = document.querySelectorAll('#formulario input');
        const respuesta = document.getElementById('respuesta');
        const nombreRaza = document.getElementById('nombre-raza').value;

        var a = false;
        
        const expresion = {
            nombre: /^[a-zA-ZÁ-ÿ\s]{1,40}$/
        }
    
        const url =  formulario.getAttribute('action');
        
        
        const validarFormulario = (e) => {
            if (expresion.nombre.test(e.target.value)) {
                document.getElementById('nombre-raza').classList.add('is-valid');
                document.getElementById('nombre-raza').classList.remove('is-invalid');
                a = true;
            } else {
                document.getElementById('nombre-raza').classList.add('is-invalid');
                a = false;
            }
        }
        inputs.forEach((input) => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
        })
        
        formulario.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formdata = new FormData(formulario);
                const nombre = formdata.get('nombreRaza');
    
                if (nombre.trim() !== '') {
                    respuesta.innerHTML = ''
                    await fetch(url, {
                            method: 'POST',
                            body: formdata
                        }).then(res => res.json())
                        .then(data => {
                            if (data === 'existe') {
                                respuesta.innerHTML = `
                                    <div class="alert alert-danger">
                                        Ya existe un registro con ese nombre
                                    </div>
                                `
                            }
                            if (data === 'update') {
                                respuesta.innerHTML = `
                                        <div class="alert alert-success">
                                            Modificado correctamente
                                        </div>
                                        `
                                const input = document.getElementById('nombre-raza');
                                input.value = "";
                                document.getElementById('titulo-raza').innerHTML = nombre
                                document.getElementById('nombre-raza').placeholder = nombre
                            }  
                        }).catch(err => {
                            console.error(err)
                        })
                } else {
                    respuesta.innerHTML = `
                                <div class="alert alert-danger">
                                    No deje el campo vacio
                                </div>
                            `
                }
            });

    </script>
@endsection()



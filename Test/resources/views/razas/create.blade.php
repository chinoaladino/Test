@extends('layouts.plantilla')
@section('title', 'home')
@section('content')
    <div class="container mt-5">
        <div class="justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ingresar Raza
                    </div>
                    <div class="card-body">
                        <label class="col-sm col-form-label" for="">Nombre de la raza</label>
                        <div class="col-sm-10">
                            <form id="formulario" action="/razas" method="POST">
                                @csrf
                                <div id="respuesta">

                                </div>
                                <div class="form-group">
                                    <input type="text" id="nombre-raza" class="form-control" name="nombreRaza" placeholder="Texto" />
                                    <div class="invalid-feedback">
                                        Ingrese un nombre valido
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block mt-2" style="width: 100%">
                                    Agregar
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

        const expresion = {
            nombre: /^[a-zA-ZÁ-ÿ\s]{1,40}$/
        }

        const validarFormulario = (e) => {
            if (expresion.nombre.test(e.target.value)) {
                document.getElementById('nombre-raza').classList.add('is-valid');
                document.getElementById('nombre-raza').classList.remove('is-invalid');

            } else {
                document.getElementById('nombre-raza').classList.add('is-invalid');
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
        })

        formulario.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formdata = new FormData(formulario);

            if (formdata.get('nombreRaza').trim() !== '') {
                respuesta.innerHTML = ''
                await fetch('/razas', {
                    method: 'POST',
                    body: formdata
                }).then( res => res.json())
                .then( data => {
                    if (data === 'Ingresado') {
                        respuesta.innerHTML = `
                            <div class="alert alert-success">
                                Ingresador correctamente
                            </div>
                        `
                        const input = document.getElementById('nombre-raza');
                        input.value = "";

                    } if (data === 'existe') {
                        respuesta.innerHTML = `
                            <div class="alert alert-danger">
                                Ya se encuentra registrada esa raza
                            </div>
                        `
                    }
                }).catch(err => {
                    console.error(err)
                })
            }
            else{
                respuesta.innerHTML = `
                    <div class="alert alert-danger">
                        No deje el campo vacio
                    </div>
                `
            }
        });

    </script>
@endsection()

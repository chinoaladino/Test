@extends('layouts.plantilla')
@section('title', 'Edit')
@section('content')
    <div id="container" class="container mt-4">
        <div class="justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Formulario para modificar Perros:</h2>
                        <p id="titulo-raza" class="text-center">{{ $perritos->nombre }}</p>
                    </div>
                    <div class="card-body">

                        <div class="col-sm-10">
                            <form id="formulario" action="{{ route('perritos.update', $perritos->id) }}" method="POST">
                                @csrf
                                <div id="respuesta"></div>

                                <label class="col-sm col-form-label">Nombre:</label>
                                <input id="nombre" type="text" class="form-control is-valid" name="nombre"
                                    value="{{ $perritos->nombre }}" placeholder="{{ $perritos->nombre }}">
                                <div id="error-nombre" class="invalid-feedback">

                                </div>
                                <label class="col-sm col-form-label">Color:</label>
                                <input id="color" type="text" class="form-control is-valid" name="color"
                                    value="{{ $perritos->color }}" placeholder="{{ $perritos->color }}">
                                <div id="error-color" class="invalid-feedback">

                                </div>
                                <label class="col-sm col-form-label">Raza:</label>
                                <select name="razaid" class="form-select is-valid" id="razaid" onchange="validarSelect()">
                                    <option value="0">Seleccione una raza</option>
                                    @foreach ($razas as $raza)
                                        <option @if ($perritos->razas_id === $raza->id) selected="true" @endif
                                            value="{{ $raza->id }}">{{ $raza->id }}-{{ $raza->nombreRaza }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-warning">Modificar</button>
                                </div>
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
        const container = document.getElementById('container');
        const respueta = document.getElementById('respuesta');
        var a = false;
        var b = false;
        var c = true
        const url = formulario.getAttribute('action');

        const expresiones = {
            nombre: /^[a-zA-ZÁ-ÿ\s]{1,40}$/,
            color: /^[a-zA-ZÁ-ÿ\s]{1,40}$/,
            raza: /^[0-9]{1}$/,
        }


        const validarSelect = () => {
            const val = document.getElementById('razaid').value;
            if (val == 0) {
                document.getElementById('razaid').classList.add('is-invalid')
                document.getElementById('razaid').classList.remove('is-valid')
                c = false;
            } else {
                document.getElementById('razaid').classList.add('is-valid')
                document.getElementById('razaid').classList.remove('is-invalid')
                c = true;
            }
        }

        const validarFormulario = (e) => {
            switch (e.target.name) {
                case 'nombre':
                    if (expresiones.nombre.test(e.target.value)) {
                        document.getElementById('nombre').classList.add('is-valid')
                        document.getElementById('nombre').classList.remove('is-invalid')
                        document.getElementById('error-nombre').innerHTML = ""
                        a = true;
                    } else {
                        document.getElementById('nombre').classList.add('is-invalid')
                        document.getElementById('nombre').classList.remove('is-valid')
                        document.getElementById('error-nombre').innerHTML = "El nombre debe ser letras entre 1-40 caracteres"
                        a = false
                    }
                    break;
                case 'color':
                    if (expresiones.nombre.test(e.target.value)) {
                        document.getElementById('color').classList.add('is-valid')
                        document.getElementById('color').classList.remove('is-invalid')
                        document.getElementById('error-color').innerHTML = ""
                        b = true;
                    } else {
                        document.getElementById('color').classList.add('is-invalid')
                        document.getElementById('error-color').innerHTML = "El color debe ser letras entre 1-40 caracteres"
                        b = false;
                    }
                    break;
                default:
                    break;
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
            input.addEventListener('mouseover', validarFormulario);
        })

        formulario.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formulario);
            const nombre = formData.get('nombre');
            const color = formData.get('color');
            const id = formData.get('razaid');
            if (expresiones.nombre.test(nombre) == false) {
                document.getElementById('nombre').classList.add('is-invalid')
                document.getElementById('error-nombre').innerHTML = "Escriba un nombre valido"
                a = false;
            } else {
                document.getElementById('nombre').classList.add('is-valid')
                document.getElementById('nombre').classList.remove('is-invalid')
                document.getElementById('error-nombre').innerHTML = ""
                a = true;
            }
            if (expresiones.color.test(color) == false) {
                document.getElementById('color').classList.add('is-invalid')
                document.getElementById('error-color').innerHTML = "Escriba un color valido"
                b = false;
            } else {
                document.getElementById('color').classList.add('is-valid')
                document.getElementById('color').classList.remove('is-invalid')
                document.getElementById('error-color').innerHTML = ""
                b = true;
            }
            if (a == false || b == false || c == false) {
                respueta.innerHTML = `
                        <div class="alert alert-danger">
                            Valide los compos para modificar
                        </div>
                    `
            } else {
                respuesta.innerHTML = ''
                await fetch(url, {
                        method: 'POST',
                        body: formData
                    }).then(res => res.json())
                    .then(data => {
                        if (data === 'update') {
                            respueta.innerHTML = `
                                <div class="alert alert-success">
                                    Modificado correctamente
                                </div>
                            `
                            document.getElementById('titulo-raza').innerHTML = nombre;
                            document.getElementById('nombre').placeholder = nombre;

                        }
                        if (data === 'existe') {
                            respueta.innerHTML = `
                                <div class="alert alert-danger">
                                    Ya existe un Perro con ese nombre
                                </div>
                            `
                        }
                    })
            }
        })

    </script>
@endsection()

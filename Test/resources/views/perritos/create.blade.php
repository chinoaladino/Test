@extends('layouts.plantilla')
@section('title', 'home')
@section('content')
    <div class="container mt-5">
        <div class="justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ingresar Perro
                    </div>
                    <div class="card-body">

                        <div class="col-sm-10">
                           @if(count($razas) > 0)
                                <form id="formulario" action="">
                                @csrf
                                <div id="respuesta">

                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm col-form-label">Nombre:</label>
                                    <input type="text" id="nombre" class="form-control" name="nombre"
                                        placeholder="Ingrese un nombre para el perro" />
                                    <div id="text-error-nombre" class="invalid-feedback">

                                    </div>
                                    <label for="" class="col-sm col-form-label">Color:</label>
                                    <input type="text" id="color" class="form-control" name="color"
                                        placeholder="Ingrese un color para el perro" />
                                    <div id="text-error-color" class="invalid-feedback">

                                    </div>
                                    <label class="col-sm col-form-label">Raza:</label>
                                    <select class="form-select is-invalid" id="razaid" name="razaid" onchange="validarSelect()"
                                        aria-label="Default select example">
                                        <option value="0" selected>Seleccione una raza</option>
                                        @foreach ($razas as $raza)
                                            <option value="{{ $raza->id}}">
                                                {{ $raza->id }}-{{ $raza->nombreRaza }}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn btn-primary">Ingresar</button>
                                    </div>
                                </div>
                            </form>
                           @else
                           <div class="alert alert-danger">
                               Usted debe ingresar una raza previo ingresar un perro
                           </div>
                               <a class="btn btn-primary btn-lg" style="width: 100%" href="{{route('razas.crate')}}">Crear raza</a>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const formulario = document.getElementById('formulario');
        const inputs = document.querySelectorAll('#formulario input')
        const respuestaColor = document.getElementById('text-error-color');
        const respuestaNombre = document.getElementById('text-error-nombre');
        const respuestaForm = document.getElementById('respuesta');

        var a = false;
        var b = false;
        var c = false;  

        const expresiones = {
            nombre: /^[a-zA-ZÁ-ÿ\s]{1,40}$/,
            color: /^[a-zA-ZÁ-ÿ\s]{1,40}$/,
            raza: /^[0-9]{1}$/,
        }

        const validarFormulario = (e) => {
            switch (e.target.name) {
                case "nombre":
                    if (expresiones.nombre.test(e.target.value)) {
                        document.getElementById('nombre').classList.add('is-valid');
                        document.getElementById('nombre').classList.remove('is-invalid');
                        respuestaNombre.innerHTML = ``
                        a = true;
                    } else {
                        document.getElementById('nombre').classList.add('is-invalid');
                        respuestaNombre.innerHTML = `Ingrese un nombre valido`
                        a = false;
                    }
                    break;
                case "color":
                    if (expresiones.color.test(e.target.value)) {
                        document.getElementById('color').classList.add('is-valid');
                        document.getElementById('color').classList.remove('is-invalid');
                        b = true;
                        respuestaColor.innerHTML = ``
                    } else {
                        document.getElementById('color').classList.add('is-invalid');
                        respuestaColor.innerHTML = `Ingrese un nombre valido`
                        b = false;
                    }
                    break;
                default:
                    a = false;
                    b = false;
                    break;
            }
        }

        const validarSelect = () => {
            const id = document.getElementById('razaid').value;
            if (id == 0) {
                document.getElementById('razaid').classList.add('is-invalid');
                document.getElementById('razaid').classList.remove('is-valid');
                c = false;
            } else {
                document.getElementById('razaid').classList.add('is-valid');
                document.getElementById('razaid').classList.remove('is-invalid');
                c = true
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
            input.addEventListener('mouseover', validarFormulario);
        })

        formulario.addEventListener('submit', async (e) => {
            e.preventDefault();
            const datos = new FormData(formulario);

            var nombre = datos.get('nombre');
            var color = datos.get('color');
            var id = datos.get('razaid');

           

            if (expresiones.nombre.test(nombre) == false) {
                document.getElementById('nombre').classList.add('is-invalid')
                respuestaNombre.innerHTML = `Escriba un nombre valido`
                a = false;
            } else {
                document.getElementById('nombre').classList.add('is-valid')
                document.getElementById('nombre').classList.remove('is-invalid')
                respuestaNombre.innerHTML = ""
                a = true;
            }
            if (expresiones.color.test(color) == false) {
                document.getElementById('color').classList.add('is-invalid')
                respuestaColor.innerHTML = "Escriba un color valido"
                b = false;
            } else {
                document.getElementById('color').classList.add('is-valid')
                document.getElementById('color').classList.remove('is-invalid')
                respuestaColor.innerHTML = ""
                b = true;
            }

            if (nombre.trim() !== '' && color.trim() !== '' && id.trim() !== '') {
                respuestaForm.innerHTML = ""

                if (a === true && b === true && c === true) {
                    respuestaForm.innerHTML = "";

                    await fetch('/perrito', {
                            method: 'POST',
                            body: datos
                        }).then(res => res.json())
                        .then(data => {
                            if (data === 'agregado') {
                                respuestaForm.innerHTML = `
                                    <div class="alert alert-success">
                                        Perro agregado correctamente!
                                    </div>
                                    `
                                document.getElementById('nombre').value = ""
                                document.getElementById('color').value = ""
                                document.getElementById('razaid').value = 0
                            }
                            if (data === 'existe') {
                                respuestaForm.innerHTML = `
                                    <div class="alert alert-danger">
                                         El perro ya se encuentra registrado
                                    </div>
                                    `
                            }
                        })

                } else {
                    respuestaForm.innerHTML = `
                                    <div class="alert alert-danger">
                                         Valide los datos que quiere ingresar
                                    </div>
                                    `
                }
                
            } else {
                respuestaForm.innerHTML = `
                    <div class="alert alert-danger">
                        No deje ningun campo vacio para ingresar
                    </div>
                `
            }

        })

    </script>
@endsection()

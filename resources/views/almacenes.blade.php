<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style-almacenes.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>BackOffice</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('/js/almacen.js')}}"></script>
</head>
<body>
@include("/common/menu")
<div class="main">
        @include("/common/topbar")


        
        <div class="detalles">
            <form action="/almacenes" step="any"method="post">
            @csrf
                <h2>Registrar almacén nuevo</h2>
                <label for="Capacidad" id="label-form">Ingresar capacidad de almacén:</label>
                <br>
                <input type="number" id="Capacidad" name="Capacidad" required>
                <input type="submit" id="Registrar" value="Registrar">
            </form>
            <br>
            @isset($message)
            <p>{{$message}}</p>
            @endif 
            <br><br>
            <div class="ordenes-recientes">
                <div class="cardHeader">
                    <h2>Almacenes</h2>
                    <a href="#" class="btn" id="verTodos">Ver Todos</a>
                    <a href="#" class="btn" id="Ocultar">Ocultar</a>
                </div>
                <table>
                    <thead>
                        <tr>
                        @if (session('success_message'))
                            <div class="alert alert-success">
                            <p style="color:green"><b>{{ session('success_message') }}</b></p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                            <p style ="color:red"><b>{{ $errors }}</b></p>
                            </div>
                        @endif
                            <th>ID</th>
                            <th>Capacidad</th>
                            <th>Fecha creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($almacenes as $key => $almacen)
                        <tr>
                            <tr id="data">
                                <td>{{ $almacen->ID_Almacen }}</td>
                                <td>{{ $almacen->Capacidad }}</td>
                                <td>{{ $almacen->created_at }}</td>
                                <td>
                                <br><br>
                                <form action="/almacenes/{{ $almacen->ID_Almacen }}" method="get">
                                    <button class="btn btn-primary btnVerMas">Ver mas</button><br><br>
                                </form>
                                <button class="btn btn-primary btnModificar">Modificar</button>
                                <button class="btn btn-primary btnCancelar">Cancelar</button><br><br>
                                <form action="/almacenes/{{ $almacen->ID_Almacen }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btnEliminar">Eliminar</button>
                                </form>
                                
                                <br>
                                <form class="formularioModificar" action="/almacenes/{{ $almacen->ID_Almacen }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <label for="Capacidad" id="label-form">Capacidad:</label>
                                    <br>
                                    <input type="number" id="ModificarCapacidad" name="Capacidad" required value="{{ $almacen->Capacidad }}">
                                    <br><br>
                                    <input class="btn btn-primary" type="submit" id="Enviar" value="Enviar">
                                </form>
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                


            </div>
            <br><br>
        </div>






        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script>
            //Menú 'Toggle'
            let toggle = document.querySelector('.toggle');
            let nav = document.querySelector('nav'); // Cambiado a 'nav'
            let main = document.querySelector('.main');

            toggle.addEventListener('click', function () {
                nav.classList.toggle('activo');
                main.classList.toggle('activo');
            });


            // Añadir clase "hovered" al ítem seleccionado.
            let list = document.querySelectorAll('nav li');

            function activarLink(event) {
                list.forEach((item) =>
                    item.classList.remove('hovered'));
                event.currentTarget.classList.add('hovered');
            }

            list.forEach((item) =>
                item.addEventListener('mouseover', activarLink));

        </script>
</body>
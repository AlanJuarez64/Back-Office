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
            <div class="ordenes-recientes">
                <div class="cardHeader">
                    <h2>Almacen N° {{$almacen->ID_Almacen}}</h2>
                </div>
                @if (session('success_message'))
                    <div class="alert alert-success">
                    <p style="color:green"><b>{{ session('success_message') }}</b></p>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <br>
                    <p style ="color:red"><b>Error: El funcionario ingresado es incorrecto</b></p><br><br>
                    <button class="btn btn-primary btnErrores">Ver detalles</button>
                    <button class="btn btn-primary btnOcultarErrores">Ocultar</button>
                    <br><br>
                    @foreach ($errors->all() as $error)
                        <p class="errores">{{ $error }}</p>
                        <br><br>
                    @endforeach
                </div>
                @endif
                @if(isset($user))
                <h3>Funcionario responsable:</h3>
                <li><b>{{$user->Nombre_Completo}}</b></li>
                <br>
                <h3>ID de Funcionario:</h3>
                <li><b>{{$funcionarioAlmacen->ID_Usuario}}</b></li>
                <br><br>
                @endif
                <button class="btn btn-primary btnCambiarFuncionario">Cambiar funcionario responsable</button>
                <button class="btn btn-primary btnCancelar">Cancelar</button>
                <br><br>
                <form class="cambiarFuncionario" action="/almacenes/{{$almacen->ID_Almacen}}/funcionario" method="post">
                    @csrf
                    @method('PUT')
                    <label for="idUsuario" id="label-form">ID Funcionario de funcionario nuevo:</label>
                    <input type="number" id="idUsuario" name="idUsuario" required value="0">
                    <br><br>
                    <input class="btn btn-primary" type="submit" id="Enviar" value="Enviar">
                </form>
                
                <br>
                <h3>Productos: </h3>
                <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Peso</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $key => $producto)
                    <tr>
                            <tr id="data">
                                <td>{{ $producto->ID_Producto }} </td>
                                <td>{{ $producto->Peso }}</td>
                                <td>{{ $producto->Cantidad }}</td>
                                <td>
                                    <br><br>
                                    <button class="btn btn-primary btnVerArticulos">Ver articulos pedidos</button>
                                    <button class="btn btn-primary btnCancelar">Cancelar</button><br><br>
                                    @foreach ($producto->articulos as $articulo)
                                    <div class="Articulos">
                                        <h4>Articulo N°: {{ $articulo->ID_Articulo }}</h4>
                                        <br>
                                        <li>Estado: {{ $articulo->Estado }}</li>
                                    </div>
                                    @endforeach
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <br><br>
        </div>
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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestión de Usuarios</title>

    <link rel="stylesheet" href="{{asset('css\style.css')}}">
    <link rel="stylesheet" href="{{asset('css\style-usuarios.css')}}">
    <script src="{{asset('/js/usuarios.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
@include("/common/menu")
<div class="main">
        @include("/common/topbar")
        <div class="gestor-usuarios">
            <!-- Formulario para agregar usuarios -->
            <form id="agregar-usuario-form" method="post" action="/usuarios/">
            @csrf
                <h2>Registrar Usuario</h2>
                <label for="name" id="label-form">Nombre:</label>
                <input type="text" id="name" name="name" required>
                <label for="email" id="label-form">Correo:</label>
                <input type="email" id="email" name="email" required>
                <label for="password" id="label-form">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Registrar</button>
            </form>
            <br><br>
            @if (session('success_message'))
                <div class="alert alert-success">
                {{ session('success_message') }}
                </div>
            @endif

            <br><br>
            <form action="/usuarios/all" method="get">
            <button id="cargar-usuarios-btn">Cargar Usuarios</button>
            <div id="lista-usuarios"> 
            </form>
            <ul>
            @isset($users)
            @foreach($users as $user)
                ID:{{ $user->id }} - {{ $user->name }} - {{ $user->email }} <br><br>
            @endforeach
            @endif
            </ul>
            </div>
            
            <!-- Formulario para eliminar usuarios -->
            <br><br>
            <form id="formEliminar">
            @csrf
            <h2>Eliminar Usuario</h2>
            <label for="idUser">ID del Usuario:</label>
            <input type="number" id="idUser" name="id" required>
            <button type="submit">Eliminar Usuario</button>
            </form>
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
</html>
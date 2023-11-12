<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-almacenes.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Gestión QC</title>
</head>
<body>
    @include("/common/menu")

    <div class="main">
        @include("/common/topbar")
   
        <div class="detalles">
        <div class="ordenes-recientes">
            <div class="cardHeader">
            <h2>Confirmación de paquetes entregados</h2>
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
                            <th>ID de Producto</th>
                            <th>Modificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articulos as $key => $articulo)
                        <tr>
                            <tr id="data">
                                <td>{{ $articulo->ID_Articulo }}</td>
                                <td>{{ $articulo->ID_Producto }}</td>
                                <td>{{ $articulo->updated_at }}</td>
                                <td>
                                <br><br>
                                <button class="btn btn-primary btnConfirmar">Confirmar Entrega</button>
                                <button class="btn btn-primary btnCancelar">Cancelar</button><br><br>
                                <form action="/entregas/{{ $articulo->ID_Articulo }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btnEliminar">Confirmar</button>
                                </form>
                                
                                <br><br>
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
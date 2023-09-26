<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Gestión QC</title>
</head>

<body>
    @include("/common/menu")


    <div class="main">
        @include("/common/topbar")

        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numeros">3,117</div>
                    <div class="cardName">Vistas Diarias</div>
                </div>
                <div class="iconoBx"><ion-icon name="eye-outline"></ion-icon></div>
            </div>

            <div class="card">
                <div>
                    <div class="numeros">405</div>
                    <div class="cardName">Ventas</div>    
                </div>
                <div class="iconoBx"><ion-icon name="bar-chart-outline"></ion-icon></div>
            </div>

            <div class="card">
                <div>
                    <div class="numeros">328</div>
                    <div class="cardName">Comentarios</div>
                </div>
                <div class="iconoBx"><ion-icon name="chatbubbles-outline"></ion-icon></div>
            </div>

            <div class="card">
                <div>
                    <div class="numeros">$9,444</div>
                    <div class="cardName">Ganancias</div>
                </div>
                <div class="iconoBx"><ion-icon name="cash-outline"></ion-icon></div>
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
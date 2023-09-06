<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('/css/style-login.css')}}">
</head>
<body>
<section class="contenido-login">
<form id="login" action="/login" method="post">
<div>
    <h1>Inicio de Sesión</h1>
    @csrf
    <input type="email" id="email" name="email" placeholder="Ingrese su email" required>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>

    <div>
    <button id="btn-login" type="submit">Iniciar sesión</button>
    </div>
</div>
</form>
</section>
</body>
</html>
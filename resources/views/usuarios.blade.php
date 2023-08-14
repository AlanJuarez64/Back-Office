<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>
</head>
<body>
    <h2>Registrar un Usuario:</h2>
    
    <form action="{{ route('usuario.registro') }}" method="post">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email">
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password">
        <br>
        <button type="submit">Registrar</button>
    </form>


    <h2>Buscar usuario</h2>
    
    <form action="{{ route('usuario.buscar') }}" method="get">
        @csrf
        <label for="name">ID del usuario:</label>
        <input type="text" name="id">
        <br>
        <button type="button">Eliminar</button>
    
</body>
</html>